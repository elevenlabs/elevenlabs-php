<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\Agents\AgentsClient;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Exceptions\ElevenlabsException;
use ElevenLabs\Services\BaseService;

/**
 * @internal The agents and tools requests `push` and `pull` make, sent through the generated
 * `$client->agents` and `$client->agents->tools` services' own request path (same base URL,
 * credentials, retries, per-method config and error handling), with API-format JSON in both
 * directions. The generated methods take and return typed models, which drop the settings this
 * SDK doesn't model; agents as code must send and keep them.
 *
 * Hand-written (see `.fernignore`).
 */
final class Transport
{
  public function __construct(private readonly AgentsClient $agents)
  {
  }

  /**
   * `GET /v1/convai/agents/{id}`.
   *
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function getAgent(string $agentId, ?string $branchId, ?array $options): array
  {
    return self::send($this->agents, 'getConfig', HttpMethod::GET, '/v1/convai/agents/' . self::segment($agentId), ['branch_id' => $branchId], null, $options);
  }

  /**
   * `POST /v1/convai/agents/create`.
   *
   * @param array<string, mixed> $config
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function createAgent(array $config, ?array $options): array
  {
    return self::send($this->agents, 'createConfig', HttpMethod::POST, '/v1/convai/agents/create', [], $config, $options);
  }

  /**
   * `PATCH /v1/convai/agents/{id}`.
   *
   * @param array<string, mixed> $config
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function updateAgent(string $agentId, array $config, ?string $branchId, ?string $versionDescription, ?array $options): array
  {
    if ($versionDescription !== null) {
      $config['version_description'] = $versionDescription;
    }
    return self::send($this->agents, 'updateConfig', HttpMethod::PATCH, '/v1/convai/agents/' . self::segment($agentId), ['branch_id' => $branchId], $config, $options);
  }

  /**
   * `GET /v1/convai/tools`, one page.
   *
   * @param array<string, mixed> $query
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function listTools(array $query, ?array $options): array
  {
    return self::send($this->agents->tools, 'listConfig', HttpMethod::GET, '/v1/convai/tools', $query, null, $options);
  }

  /**
   * `GET /v1/convai/tools/{id}`.
   *
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function getTool(string $toolId, ?array $options): array
  {
    return self::send($this->agents->tools, 'getConfig', HttpMethod::GET, '/v1/convai/tools/' . self::segment($toolId), [], null, $options);
  }

  /**
   * `POST /v1/convai/tools`.
   *
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function createTool(mixed $toolConfig, ?array $options): array
  {
    return self::send($this->agents->tools, 'createConfig', HttpMethod::POST, '/v1/convai/tools', [], ['tool_config' => $toolConfig], $options);
  }

  /**
   * `PATCH /v1/convai/tools/{id}`.
   *
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   */
  public function updateTool(string $toolId, mixed $toolConfig, ?array $options): array
  {
    return self::send($this->agents->tools, 'updateConfig', HttpMethod::PATCH, '/v1/convai/tools/' . self::segment($toolId), [], ['tool_config' => $toolConfig], $options);
  }

  private static function segment(string $value): string
  {
    return \ElevenLabs\Core\Client\RawClient::encodePathParam($value);
  }

  /**
   * Sends a JSON request exactly as the service's generated methods do, and returns the response
   * body in API format.
   *
   * @param string $methodConfig The service's method-level config property the generated method reads, such as `getConfig`.
   * @param array<string, mixed> $query
   * @param ?array<string, mixed> $options
   * @return array<string, mixed>
   * @throws ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  private static function send(
    BaseService $service,
    string $methodConfig,
    HttpMethod $method,
    string $path,
    array $query,
    mixed $body,
    ?array $options,
  ): array {
    $query = array_filter($query, static fn(mixed $value): bool => $value !== null);
    $send = \Closure::bind(
      function () use ($methodConfig, $method, $path, $query, $body, $options): string {
        /** @var BaseService $this */
        $resolvedConfig = $this->getResolvedConfig($this->{$methodConfig}, $options);
        $response = $this->sendJsonRequest(
          new JsonApiRequest(
            baseUrl: $this->getBaseUrl($resolvedConfig),
            path: $path,
            method: $method,
            query: $query,
            body: $body
          ),
          $resolvedConfig
        );
        return $response->getBody()->getContents();
      },
      $service,
      $service::class
    );
    $text = $send();
    if (trim($text) === '') {
      return [];
    }
    try {
      $decoded = Wire::decodeJson($text);
    } catch (\JsonException $e) {
      throw new ElevenlabsException(message: "Failed to deserialize the response: {$e->getMessage()}", previous: $e);
    }
    $fields = ConfigWire::fields($decoded);
    if ($fields === null) {
      throw new ElevenlabsException(message: 'Failed to deserialize the response: expected a JSON object');
    }
    return $fields;
  }
}
