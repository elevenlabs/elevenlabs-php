<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\Agents\AgentsClient;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\ElevenLabs;

/**
 * Adds `push()` and `pull()` for agents written as code to the agents client.
 *
 *     $agents = new AgentsAsCode($client);
 *     $result = $agents->push($agent);                          // creates the agent and its tools
 *     $agents->push($agent, agentId: $result->agentId);         // later: updates only what changed
 *
 *     $project = AgentProject::open('.');
 *     $agents->push($agent, project: $project);                 // or let a project track the ids
 *     $pulled = $agents->pull('agent_123', project: $project);
 *
 * Requests go through the generated `$client->agents` and `$client->agents->tools` services, so
 * base URL, credentials, retries and per-method config set on them apply. `$options` takes the
 * same per-request options as the generated methods and is passed to every request.
 *
 * Hand-written rather than generated (see `.fernignore`). The generated root client and agents
 * client are regenerated on every release, so this is a separate entry point rather than methods
 * on them. Mirrors `agents.push` / `agents.pull` in the Python/TS SDKs.
 */
final class AgentsAsCode
{
  private readonly Transport $transport;

  /**
   * @param ElevenLabs|AgentsClient $client The root client, or its `agents` client.
   */
  public function __construct(ElevenLabs|AgentsClient $client)
  {
    $this->transport = new Transport($client instanceof ElevenLabs ? $client->agents : $client);
  }

  /**
   * Creates or updates an agent and every webhook and client tool it uses, in one call.
   *
   * 1. Validates the agent, so an invalid one writes nothing.
   * 2. Creates each tool that's new and updates each one that changed. Which tools already exist
   *    comes from the project's `tools.json`, or, without a project, from the tools the agent
   *    (`$agentId`) already uses, by name: on its main branch, or on `$branchId` when given. Tools
   *    other agents use are never touched.
   * 3. Creates the agent, or updates it, with the tools' ids filled in.
   *
   * Settings the SDK doesn't model, kept from a loaded config, are sent too. Tools the agent stops
   * using are reported as `"detached"`, not deleted.
   *
   * @param ?string $agentId The agent to update. Without it (and without a project that knows the
   *   agent), `push` creates a new agent, so keep the returned `agentId`. Not allowed with `$project`.
   * @param ?AgentProject $project A project in the CLI's layout. It supplies the ids and records
   *   new ones; one opened from a directory is saved, also when a request failed partway.
   * @param ?string $branchId Update this branch of the agent instead of its main branch.
   * @param ?string $versionDescription Describes the new version.
   * @param ?array<string, mixed> $options Per-request options, passed to every request.
   * @throws AgentValidationError if the agent is invalid, before any request
   * @throws \InvalidArgumentException for `$branchId` without an agent to update, before any request
   * @throws AgentProjectError if the project can't say which agent or tool this is
   * @throws AgentPushError if a request fails, with what was already written
   */
  public function push(
    Agent $agent,
    ?string $agentId = null,
    ?AgentProject $project = null,
    ?string $branchId = null,
    ?string $versionDescription = null,
    ?array $options = null,
  ): AgentPushResult {
    if ($project !== null && $agentId !== null) {
      throw new \InvalidArgumentException("Pass agentId or project to push(), not both: the project records the agent's id");
    }
    $agent->validate();
    $project?->checkBranch($agent, $branchId);

    $tools = $agent->tools();
    $agentId = $project !== null ? $project->agentId($agent) : $agentId;
    if ($branchId !== null && $agentId === null) {
      throw new \InvalidArgumentException(
        "push() got branchId \"{$branchId}\" but no agent to update: pass agentId, or a project that records the agent's id"
      );
    }
    $result = new AgentPushResult();
    /** @var array<string, string> $ids */
    $ids = [];
    $step = "Couldn't read the agent's tools";
    try {
      // The tools the agent already uses. With a project they're matched by recorded id; without
      // one, by name among the tools this agent uses, so a same-named tool another agent uses is
      // never touched.
      $inUse = $agentId === null
        ? []
        : ($branchId !== null
          ? $this->toolsOnBranch($agentId, $branchId, $options)
          : $this->toolsUsedBy($agentId, $options));
      $usedByName = [];
      foreach ($inUse as $remote) {
        $usedByName[self::toolName($remote)] = $remote;
      }

      foreach ($tools as $tool) {
        $name = $tool->name();
        $knownId = $project !== null ? $project->toolId($tool) : self::idOf($usedByName[$name] ?? null);
        $remote = null;
        if ($knownId !== null) {
          $step = "Couldn't read tool \"{$name}\" ({$knownId})";
          foreach ($inUse as $candidate) {
            if (self::idOf($candidate) === $knownId) {
              $remote = $candidate;
              break;
            }
          }
          $remote ??= $this->transport->getTool($knownId, $options);
        }
        $config = $project?->unchangedRaw($tool);
        $config = $config === null ? $tool->toJson() : Wire::canonical($config);
        $remoteId = self::idOf($remote);
        if ($remote !== null && $remoteId !== null && self::sameTool($remote, $config)) {
          $ids[$name] = $remoteId;
          $result->tools[$name] = new ToolPushResult($remoteId, 'unchanged');
          // The server already matches, but the project may hold an older definition: bring it up to date.
          $project?->recordTool($tool, $remoteId, $config);
          continue;
        }
        if ($remote !== null && $remoteId !== null) {
          $step = "Couldn't update tool \"{$name}\" ({$remoteId})";
          $this->transport->updateTool($remoteId, $config, $options);
          $ids[$name] = $remoteId;
          $result->tools[$name] = new ToolPushResult($remoteId, 'updated');
        } else {
          $step = "Couldn't create tool \"{$name}\"";
          $created = self::idOf($this->transport->createTool($config, $options));
          if ($created === null) {
            throw new \UnexpectedValueException('The response has no tool id');
          }
          $ids[$name] = $created;
          $result->tools[$name] = new ToolPushResult($created, 'created');
        }
        $project?->recordTool($tool, $ids[$name], $config);
      }

      $step = "Couldn't build agent \"{$agent->name()}\"";
      $config = $agent->toJson($ids);

      // Every id the new config still uses, wherever it is: the agent's tool_ids and the workflow's
      // nodes. The others are reported as detached once the agent write succeeds, not before: until
      // then the server's agent still uses them.
      $kept = array_flip(ConfigWire::agentToolIds($config));
      /** @var array<string, ToolPushResult> $detached */
      $detached = [];
      foreach ($inUse as $remote) {
        $remoteId = self::idOf($remote);
        $remoteName = self::toolName($remote);
        if ($remoteId !== null && !isset($kept[$remoteId]) && !isset($result->tools[$remoteName])) {
          $detached[$remoteName] = new ToolPushResult($remoteId, 'detached');
        }
      }

      $versionId = null;
      if ($agentId === null) {
        $step = "Couldn't create agent \"{$agent->name()}\"";
        $created = $this->transport->createAgent($config, $options);
        $id = is_string($created['agent_id'] ?? null) ? $created['agent_id'] : null;
        if ($id === null) {
          throw new \UnexpectedValueException('The response has no agent_id');
        }
        $result->action = 'created';
      } else {
        $step = "Couldn't update agent \"{$agent->name()}\" ({$agentId})";
        $updated = $this->transport->updateAgent($agentId, $config, $branchId, $versionDescription, $options);
        $versionId = is_string($updated['version_id'] ?? null) ? $updated['version_id'] : null;
        $id = $agentId;
        $result->action = 'updated';
      }
      $result->agentId = $id;
      foreach ($detached as $name => $tool) {
        $result->tools[$name] = $tool;
      }
      $project?->recordAgent($agent, $id, $config, branchId: $branchId, versionId: $versionId);
    } catch (\Throwable $e) {
      self::saveQuietly($project);
      throw new AgentPushError($step, $result, $e);
    }
    if ($project?->dir !== null) {
      $project->save();
    }
    return $result;
  }

  /**
   * Loads an existing agent as an {@see Agent}, with its webhook and client tools as `Tool`
   * objects; other kinds stay attached by id. With a project, also writes the agent and its tools
   * there, in the CLI's layout, and records their ids.
   *
   * @param ?array<string, mixed> $options Per-request options, passed to every request.
   * @throws AgentProjectError if the project has no file for `$branchId`
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function pull(
    string $agentId,
    ?AgentProject $project = null,
    ?string $branchId = null,
    ?array $options = null,
  ): Agent {
    $project?->checkBranchById($agentId, $branchId);
    $live = $this->transport->getAgent($agentId, $branchId, $options);
    // The CLI's pulled-config shape: these keys only, so ids and server metadata stay out of the file.
    $config = [
      'name' => $live['name'] ?? '',
      'conversation_config' => $live['conversation_config'] ?? new \stdClass(),
      'platform_settings' => $live['platform_settings'] ?? new \stdClass(),
      'tags' => $live['tags'] ?? [],
    ];
    if (ConfigWire::isObject($live['workflow'] ?? null)) {
      $config['workflow'] = $live['workflow'];
    }

    /** @var array<string, Tool> $toolsById */
    $toolsById = [];
    $toolConfigs = [];
    foreach (ConfigWire::agentToolIds($config) as $id) {
      $remote = $this->transport->getTool($id, $options);
      $tool = Tool::fromJson($remote['tool_config'] ?? []);
      // tools.json lists webhook and client tools; others (MCP...) stay attached by id.
      if ($tool->kind() === 'webhook' || $tool->kind() === 'client') {
        $toolsById[$id] = $tool;
        $toolConfigs[$id] = Wire::canonical($remote['tool_config']);
      }
    }

    $agent = Agent::fromJson($config, $toolsById);
    if ($project !== null) {
      foreach ($toolsById as $id => $tool) {
        $project->recordTool($tool, (string) $id, $toolConfigs[$id], 'id');
      }
      $versionId = is_string($live['version_id'] ?? null) ? $live['version_id'] : null;
      $project->recordAgent($agent, $agentId, $config, branchId: $branchId, versionId: $versionId, matchBy: 'id');
      if ($project->dir !== null) {
        $project->save();
      }
    }
    return $agent;
  }

  /**
   * The tools the agent's main branch uses, following the cursor.
   *
   * @param ?array<string, mixed> $options
   * @return list<array<string, mixed>>
   */
  private function toolsUsedBy(string $agentId, ?array $options): array
  {
    $all = [];
    $cursor = null;
    do {
      $page = $this->transport->listTools(
        ['used_by_agent_id' => $agentId, 'page_size' => 100, 'cursor' => $cursor],
        $options,
      );
      foreach (is_array($page['tools'] ?? null) ? $page['tools'] : [] as $tool) {
        $fields = ConfigWire::fields($tool);
        if ($fields !== null) {
          $all[] = $fields;
        }
      }
      $next = $page['next_cursor'] ?? null;
      $cursor = ($page['has_more'] ?? false) === true && is_string($next) && $next !== '' ? $next : null;
    } while ($cursor !== null);
    return $all;
  }

  /**
   * The tools a branch of the agent uses. The tools API's `used_by_agent_id` covers the main branch
   * only, so they come from the branch's config, by id.
   *
   * @param ?array<string, mixed> $options
   * @return list<array<string, mixed>>
   */
  private function toolsOnBranch(string $agentId, string $branchId, ?array $options): array
  {
    $branch = $this->transport->getAgent($agentId, $branchId, $options);
    $tools = [];
    foreach (ConfigWire::agentToolIds($branch) as $id) {
      $tools[] = $this->transport->getTool($id, $options);
    }
    return $tools;
  }

  /**
   * @param ?array<string, mixed> $remote
   */
  private static function idOf(?array $remote): ?string
  {
    $id = $remote['id'] ?? null;
    return is_string($id) ? $id : null;
  }

  /**
   * @param array<string, mixed> $remote
   */
  private static function toolName(array $remote): string
  {
    $name = ConfigWire::get($remote, ['tool_config', 'name']);
    return is_string($name) ? $name : (string) ($remote['id'] ?? '');
  }

  /**
   * Whether the server already has the config `push` would send.
   *
   * Both sides are compared as the generated config model holds them, so fields the SDK doesn't
   * model (which the API adds on get, at any level) and its `null`s for unset fields don't count
   * as a change: the builder itself keeps unmodeled fields, so comparing its output would see
   * every tool as changed and PATCH it on every push. The config to send must also be contained
   * in the server's, so a change to any field it carries, a loaded tool's unmodeled ones
   * included, still counts.
   *
   * @param array<string, mixed> $remote
   */
  private static function sameTool(array $remote, mixed $config): bool
  {
    try {
      $wire = $remote['tool_config'] ?? null;
      return ConfigWire::modeled(Tool::fromJson(ConfigWire::fields($wire) ?? []))
          === ConfigWire::modeled(Tool::fromJson(ConfigWire::fields($config) ?? []))
        && ConfigWire::isSubset($config, $wire);
    } catch (\Throwable) {
      return false;
    }
  }

  private static function saveQuietly(?AgentProject $project): void
  {
    if ($project?->dir === null) {
      return;
    }
    try {
      $project->save();
    } catch (\Throwable) {
      // The push error is the one to report; the ids it carries are in the thrown result.
    }
  }
}
