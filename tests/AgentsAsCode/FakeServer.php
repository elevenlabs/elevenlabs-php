<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\AgentsAsCode;

use ElevenLabs\AgentsAsCode\ConfigWire;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\ElevenLabs;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * An in-memory stand-in for the agents and tools endpoints `push` and `pull` use, plugged in as
 * the client's PSR-18 HTTP client. Modelled on the JS SDK's `fakeServer.ts`.
 */
class FakeServer implements ClientInterface
{
  /** @var array<string, array{config: mixed, usedBy: list<string>}> */
  public array $tools = [];

  /** @var array<string, array<string, mixed>> */
  public array $agents = [];

  /** @var array<string, array<string, mixed>> Branch configs by `agentId/branchId`. Only the main branch counts for `used_by_agent_id`, as in the API. */
  public array $branches = [];

  /** @var list<array{method: string, path: string, query: array<string, mixed>, body: mixed}> */
  public array $calls = [];

  /** A regex: fails every request whose `METHOD path` matches. */
  public ?string $failOn = null;

  private int $next = 1;

  /**
   * @param list<string> $usedBy
   */
  public function addTool(string $id, mixed $config, array $usedBy = []): void
  {
    $this->tools[$id] = ['config' => $config, 'usedBy' => $usedBy];
  }

  /**
   * @param array<string, mixed> $config
   */
  public function addAgent(string $id, array $config): void
  {
    $this->agents[$id] = $config;
  }

  /** Forgets the calls made so far. */
  public function clearCalls(): void
  {
    $this->calls = [];
  }

  public function client(): ElevenLabs
  {
    // Through Guzzle, which honours the SDK's timeout option, with this server as its handler.
    $handler = fn(RequestInterface $request): PromiseInterface => Create::promiseFor($this->sendRequest($request));
    return new ElevenLabs('test', ['client' => new GuzzleClient(['handler' => $handler]), 'maxRetries' => 0]);
  }

  /**
   * The calls that change something, as `METHOD path`.
   *
   * @return list<string>
   */
  public function writes(): array
  {
    $out = [];
    foreach ($this->calls as $call) {
      if ($call['method'] !== 'GET') {
        $out[] = "{$call['method']} {$call['path']}";
      }
    }
    return $out;
  }

  public function sendRequest(RequestInterface $request): ResponseInterface
  {
    $method = $request->getMethod();
    $path = $request->getUri()->getPath();
    parse_str($request->getUri()->getQuery(), $query);
    $text = (string) $request->getBody();
    /** @var mixed $body */
    $body = $text === '' ? null : Wire::decodeJson($text);
    /** @var array<string, mixed> $query */
    $this->calls[] = ['method' => $method, 'path' => $path, 'query' => $query, 'body' => $body];
    if ($this->failOn !== null && preg_match($this->failOn, "{$method} {$path}") === 1) {
      return self::json(['detail' => 'boom'], 500);
    }
    $parts = explode('/', $path); // /v1/convai/<kind>/<id>
    $kind = $parts[3] ?? null;
    $id = $parts[4] ?? null;
    if ($kind === 'tools') {
      if ($method === 'GET' && $id === null) {
        $agentId = $query['used_by_agent_id'] ?? null;
        $tools = [];
        foreach ($this->tools as $toolId => $tool) {
          if ($agentId === null || in_array($agentId, $tool['usedBy'], true)) {
            $tools[] = self::toolResponse((string) $toolId, $tool['config']);
          }
        }
        return self::json(['tools' => $tools, 'has_more' => false]);
      }
      if ($method === 'POST') {
        $toolId = 'tool_new_' . $this->next++;
        $this->tools[$toolId] = ['config' => $body['tool_config'], 'usedBy' => []];
        return self::json(self::toolResponse($toolId, $body['tool_config']));
      }
      if ($id === null || !isset($this->tools[$id])) {
        return self::json(['detail' => 'not found'], 404);
      }
      if ($method === 'PATCH') {
        $this->tools[$id]['config'] = $body['tool_config'];
      }
      return self::json(self::toolResponse($id, $this->tools[$id]['config']));
    }
    if ($kind === 'agents' && $id !== null) {
      if ($method === 'POST' && $id === 'create') {
        $agentId = 'agent_new_' . $this->next++;
        $this->storeAgent($agentId, $body);
        return self::json(['agent_id' => $agentId]);
      }
      $branchId = $query['branch_id'] ?? null;
      if (is_string($branchId)) {
        $key = "{$id}/{$branchId}";
        if ($method === 'PATCH') {
          $this->branches[$key] = array_merge($this->branches[$key] ?? [], $body);
        }
        return isset($this->branches[$key])
          ? self::json(self::agentResponse($id, $this->branches[$key]))
          : self::json(['detail' => 'not found'], 404);
      }
      if ($method === 'PATCH') {
        $this->storeAgent($id, array_merge($this->agents[$id] ?? [], $body));
      }
      return isset($this->agents[$id])
        ? self::json(self::agentResponse($id, $this->agents[$id]))
        : self::json(['detail' => 'not found'], 404);
    }
    throw new \RuntimeException("unexpected request {$method} {$path}");
  }

  /**
   * @param array<string, mixed> $config
   */
  private function storeAgent(string $agentId, array $config): void
  {
    $this->agents[$agentId] = $config;
    $ids = ConfigWire::agentToolIds($config);
    foreach ($this->tools as $toolId => $tool) {
      $usedBy = array_values(array_filter($tool['usedBy'], static fn(string $a): bool => $a !== $agentId));
      if (in_array((string) $toolId, $ids, true)) {
        $usedBy[] = $agentId;
      }
      $this->tools[$toolId]['usedBy'] = $usedBy;
    }
  }

  /**
   * @return array<string, mixed>
   */
  private static function toolResponse(string $id, mixed $config): array
  {
    return [
      'id' => $id,
      'tool_config' => $config,
      'access_info' => ['is_creator' => true, 'creator_name' => 'a', 'creator_email' => 'a@example.com', 'role' => 'admin'],
      'usage_stats' => ['avg_latency_secs' => 0.1],
    ];
  }

  /**
   * The defaults the API fills into a stored workflow.
   *
   * @param array<string, mixed> $workflow
   * @return array<string, mixed>
   */
  private static function withServerDefaults(array $workflow): array
  {
    $nodes = [];
    foreach ((array) ($workflow['nodes'] ?? []) as $id => $node) {
      $nodes[$id] = ($node['type'] ?? null) === 'override_agent'
        ? array_merge([
          'conversation_config' => new \stdClass(),
          'additional_knowledge_base' => [],
          'additional_tool_ids' => [],
          'entry_behavior' => 'generate_immediately',
          'allow_interruptions_on_entry' => true,
        ], $node)
        : $node;
    }
    $edges = [];
    foreach ((array) ($workflow['edges'] ?? []) as $id => $edge) {
      $edges[$id] = array_merge(['reroutes' => []], (array) $edge);
    }
    return array_merge(['prevent_subagent_loops' => false], $workflow, [
      'nodes' => $nodes,
      'edges' => $edges === [] ? new \stdClass() : $edges,
    ]);
  }

  /**
   * @param array<string, mixed> $config
   * @return array<string, mixed>
   */
  private static function agentResponse(string $id, array $config): array
  {
    $response = array_merge([
      'agent_id' => $id,
      'metadata' => ['created_at_unix_secs' => 1, 'updated_at_unix_secs' => 1],
      'created_at_unix_secs' => 1,
      'updated_at_unix_secs' => 1,
      'version_id' => 'ver_1',
    ], $config);
    if (is_array($config['workflow'] ?? null)) {
      $response['workflow'] = self::withServerDefaults($config['workflow']);
    }
    return $response;
  }

  private static function json(mixed $body, int $status = 200): ResponseInterface
  {
    return new Response($status, ['Content-Type' => 'application/json'], (string) json_encode($body));
  }
}
