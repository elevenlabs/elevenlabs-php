<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * An agents-as-code project in the ElevenLabs CLI's layout: `agents.json` and `tools.json` list the
 * agents and tools with their ids, and each one's config sits in `agent_configs/` or
 * `tool_configs/` in API format. A project made by `elevenlabs agents init` / `pull` works here,
 * and one written here works with the CLI.
 *
 * Pass it to {@see AgentsAsCode::push()} and {@see AgentsAsCode::pull()}: the project records
 * which agent and tools on the server each definition is, so pushing again updates them instead
 * of making copies.
 *
 *     $project = AgentProject::open('.');
 *     $agent = $project->agent('Support line');
 *     $agent->update(prompt: '...');
 *     (new AgentsAsCode($client))->push($agent, project: $project);
 *
 * Hand-written (see `.fernignore`), mirroring `AgentProject` in the Python/TS SDKs.
 */
final class AgentProject
{
  public const AGENTS_FILE = 'agents.json';
  public const TOOLS_FILE = 'tools.json';
  public const AGENT_CONFIGS_DIR = 'agent_configs';
  public const TOOL_CONFIGS_DIR = 'tool_configs';

  /** @var array<string, string> Path => text, as loaded or last saved. */
  private array $files = [];

  /**
   * @var list<array{entry: array<string, mixed>, agent: Agent}>
   */
  private array $agentSlots = [];

  /**
   * @var list<array{entry: array<string, mixed>, tool: Tool, raw: mixed, baseline: ?string}>
   */
  private array $toolSlots = [];

  /** @var array<string, string> Paths written since loading, with their new contents. */
  private array $changed = [];

  /** @var array<string, true> Paths in use, so new files don't overwrite one the project doesn't list. */
  private array $taken = [];

  /**
   * @param array<string, string> $files
   * @param list<string> $taken
   * @param ?string $dir The directory the project was opened from, if any. `save()` writes there.
   */
  private function __construct(array $files, public readonly ?string $dir = null, array $taken = [])
  {
    foreach ($files as $path => $text) {
      $this->files[ProjectFormat::normalizePath((string) $path)] = $text;
    }
    foreach (array_merge(array_keys($this->files), $taken) as $path) {
      $this->taken[ProjectFormat::normalizePath((string) $path)] = true;
    }
    $this->load();
  }

  /**
   * A project from file contents, keyed by path relative to the project root. No I/O. Only
   * `agents.json`, `tools.json` and the config files they list are read; missing index files
   * mean an empty project.
   *
   * @param array<string, string> $files
   * @throws AgentProjectError
   */
  public static function fromFiles(array $files): self
  {
    return new self($files);
  }

  /**
   * Reads the project in `$dir`. A directory without `agents.json` and `tools.json` opens as an
   * empty project, and `save()` creates them.
   *
   * @throws AgentProjectError
   */
  public static function open(string $dir): self
  {
    $read = ProjectFiles::read($dir);
    return new self($read['files'], $read['root'], $read['taken']);
  }

  /**
   * Every agent in the project, in `agents.json` order.
   *
   * @return list<Agent>
   */
  public function agents(): array
  {
    return array_map(static fn(array $slot): Agent => $slot['agent'], $this->agentSlots);
  }

  /**
   * The agent named `$name`. The same object every time, so edits to it are what
   * `push($agent, project: $project)` sends.
   *
   * @throws AgentProjectError if no agent, or more than one, has that name
   */
  public function agent(string $name): Agent
  {
    $matches = array_values(array_filter($this->agentSlots, static fn(array $slot): bool => $slot['agent']->name() === $name));
    if (count($matches) !== 1) {
      throw new AgentProjectError(
        $matches === []
          ? "No agent named \"{$name}\" in " . self::AGENTS_FILE
          : count($matches) . ' agents in ' . self::AGENTS_FILE . " are named \"{$name}\""
      );
    }
    return $matches[0]['agent'];
  }

  /**
   * Every tool in `tools.json`, in order.
   *
   * @return list<Tool>
   */
  public function tools(): array
  {
    return array_map(static fn(array $slot): Tool => $slot['tool'], $this->toolSlots);
  }

  /** The id `agents.json` records for this agent, if it was pushed or pulled. */
  public function agentId(Agent $agent): ?string
  {
    $slot = $this->agentSlot($agent);
    $id = $slot === null ? null : ($this->agentSlots[$slot]['entry']['id'] ?? null);
    return is_string($id) ? $id : null;
  }

  /** The id `tools.json` records for this tool, if it was pushed or pulled. */
  public function toolId(Tool $tool): ?string
  {
    $slot = $this->toolSlot($tool);
    $id = $slot === null ? null : ($this->toolSlots[$slot]['entry']['id'] ?? null);
    return is_string($id) ? $id : null;
  }

  /**
   * The project's files, keyed by path: the index files and every config they list, branch
   * configs included, with what push and pull wrote since loading. Files nothing changed keep
   * their exact text.
   *
   * @return array<string, string>
   */
  public function toFiles(): array
  {
    $files = [];
    $files[self::AGENTS_FILE] = $this->changed[self::AGENTS_FILE] ?? $this->files[self::AGENTS_FILE] ?? $this->agentsIndex();
    $files[self::TOOLS_FILE] = $this->changed[self::TOOLS_FILE] ?? $this->files[self::TOOLS_FILE] ?? $this->toolsIndex();
    $paths = [];
    foreach ($this->agentSlots as $slot) {
      $paths[] = (string) $slot['entry']['config'];
    }
    foreach ($this->agentSlots as $slot) {
      foreach (ConfigWire::fields($slot['entry']['branches'] ?? null) ?? [] as $branch) {
        $config = ConfigWire::get($branch, ['config']);
        if (is_string($config)) {
          $paths[] = $config;
        }
      }
    }
    foreach ($this->toolSlots as $slot) {
      $paths[] = (string) $slot['entry']['config'];
    }
    foreach ($paths as $path) {
      $key = ProjectFormat::normalizePath($path);
      $text = $this->changed[$key] ?? $this->files[$key] ?? null;
      if ($text !== null) {
        $files[$path] = $text;
      }
    }
    return $files;
  }

  /**
   * The paths push and pull changed since the project was loaded or last saved.
   *
   * @return list<string>
   */
  public function changedFiles(): array
  {
    return array_map('strval', array_keys($this->changed));
  }

  /**
   * Writes the files push and pull changed to the project's directory, and returns their paths.
   * `push()` and `pull()` call this themselves for a project opened with `open()`.
   *
   * @return list<string>
   * @throws AgentProjectError if the project wasn't opened from a directory, or a file can't be written
   */
  public function save(): array
  {
    if ($this->dir === null) {
      throw new AgentProjectError("This project wasn't opened from a directory; use toFiles() instead");
    }
    $written = $this->changed;
    if ($written === []) {
      return [];
    }
    ProjectFiles::write($this->dir, $written);
    foreach ($written as $path => $text) {
      $this->files[(string) $path] = $text;
    }
    $this->changed = [];
    return array_map('strval', array_keys($written));
  }

  /**
   * @internal The loaded config to send for a tool whose definition matches its project entry
   * (the loaded object, or one rebuilt in code with the same name), so fields this SDK doesn't
   * model survive. A tool rebuilt in code can't hold the entry's unmodeled fields, so it matches
   * when it equals the entry's modeled fields: those the generated config model declares.
   */
  public function unchangedRaw(Tool $tool): mixed
  {
    $slot = $this->toolSlot($tool);
    if ($slot === null) {
      return null;
    }
    ['raw' => $raw, 'baseline' => $baseline, 'tool' => $loaded] = $this->toolSlots[$slot];
    if ($raw === null || $baseline === null) {
      return null;
    }
    $current = self::safeJson($tool);
    if ($current === $baseline) {
      return Wire::deepCopy($raw);
    }
    $modeled = $loaded === $tool ? null : self::modeledKeys($loaded);
    if ($current === null || $modeled === null) {
      return null;
    }
    $loadedWire = ConfigWire::fields(Wire::decodeJson($baseline)) ?? [];
    return Wire::encode(Wire::canonical(array_intersect_key($loadedWire, $modeled))) === $current
      ? Wire::deepCopy($raw)
      : null;
  }

  /**
   * The top-level fields the tool's generated config model declares, or null for a tool kind
   * without one.
   *
   * @return array<string, true>|null
   */
  private static function modeledKeys(Tool $tool): ?array
  {
    if ($tool->kind() !== 'webhook' && $tool->kind() !== 'client') {
      return null;
    }
    try {
      $model = $tool->buildConfig();
    } catch (\Throwable) {
      return null;
    }
    $keys = ['type' => true];
    foreach ((new \ReflectionObject($model))->getProperties() as $property) {
      $attribute = $property->getAttributes(JsonProperty::class)[0] ?? null;
      if ($attribute !== null) {
        $keys[$attribute->newInstance()->name] = true;
      }
    }
    return $keys;
  }

  /**
   * @internal Records a tool's id and the config now on the server, adding an entry if it's new.
   * Push finds the entry by definition; pull, by id.
   *
   * @param "definition"|"id" $matchBy
   */
  public function recordTool(Tool $tool, string $id, mixed $config, string $matchBy = 'definition'): void
  {
    $slot = $matchBy === 'id' ? $this->toolSlotById($id) : $this->toolSlot($tool);
    if ($slot === null) {
      $path = ProjectFormat::uniquePath(self::TOOL_CONFIGS_DIR, $tool->name(), $this->taken);
      $this->taken[$path] = true;
      $this->toolSlots[] = ['entry' => ['type' => $tool->kind(), 'config' => $path], 'tool' => $tool, 'raw' => null, 'baseline' => null];
      $slot = count($this->toolSlots) - 1;
    }
    $this->toolSlots[$slot]['tool'] = $tool;
    $this->toolSlots[$slot]['entry']['id'] = $id;
    $this->toolSlots[$slot]['entry']['type'] = $tool->kind();
    $this->toolSlots[$slot]['raw'] = Wire::deepCopy($config);
    $this->toolSlots[$slot]['baseline'] = self::safeJson($tool);
    $this->write((string) $this->toolSlots[$slot]['entry']['config'], ProjectFormat::formatConfig($config));
    $this->write(self::TOOLS_FILE, $this->toolsIndex());
  }

  /**
   * @internal Records an agent's id and its config, adding an entry if it's new. Push matches like
   * `recordTool()`. A branch's config goes in the branch's own file.
   *
   * @param array<string, mixed> $config
   * @param "definition"|"id" $matchBy
   */
  public function recordAgent(
    Agent $agent,
    string $id,
    array $config,
    ?string $branchId = null,
    ?string $versionId = null,
    string $matchBy = 'definition',
  ): void {
    $slot = $matchBy === 'id' ? $this->agentSlotById($id) : $this->agentSlot($agent);
    if ($slot === null) {
      $path = ProjectFormat::uniquePath(self::AGENT_CONFIGS_DIR, $agent->name(), $this->taken);
      $this->taken[$path] = true;
      $this->agentSlots[] = ['entry' => ['config' => $path], 'agent' => $agent];
      $slot = count($this->agentSlots) - 1;
    }
    $entry = &$this->agentSlots[$slot]['entry'];
    $entry['id'] = $id;
    $branches = ConfigWire::fields($entry['branches'] ?? null) ?? [];
    $branchKey = null;
    foreach ($branches as $key => $branch) {
      if ($branchId !== null && ConfigWire::get($branch, ['branch_id']) === $branchId) {
        $branchKey = $key;
        break;
      }
    }
    // A branch has its own file; the slot's agent is the main branch's, which a branch must not replace.
    if ($branchKey === null) {
      $this->agentSlots[$slot]['agent'] = $agent;
    }
    $file = (string) $entry['config'];
    if ($branchKey !== null) {
      $branch = ConfigWire::fields($branches[$branchKey]) ?? [];
      // Like the CLI: the version the server reports, on the branch entry it belongs to.
      if ($versionId !== null) {
        $branch['version_id'] = $versionId;
      }
      // Never the main branch's file: checkBranch() has made sure the branch has its own.
      $branchFile = $branch['config'] ?? null;
      if (!is_string($branchFile) || $branchFile === '') {
        unset($entry);
        throw self::noBranchFile($branchId ?? '', $agent->name());
      }
      $branches[$branchKey] = $branch;
      $entry['branches'] = $branches;
      $file = $branchFile;
    } elseif ($versionId !== null) {
      $entry['version_id'] = $versionId;
    }
    unset($entry);
    $this->write($file, ProjectFormat::formatConfig($config));
    $this->write(self::AGENTS_FILE, $this->agentsIndex());
  }

  /**
   * @internal Rejects a branch the project has no file for, before anything is written: its
   * settings would otherwise land in the main branch's file, and a later CLI push would send them
   * to the main branch.
   *
   * @throws AgentProjectError
   */
  public function checkBranch(Agent $agent, ?string $branchId): void
  {
    $this->checkBranchOf($this->agentSlot($agent), $agent->name(), $branchId);
  }

  /**
   * @internal `checkBranch()` for `pull`, which finds the agent by id.
   *
   * @throws AgentProjectError
   */
  public function checkBranchById(string $agentId, ?string $branchId): void
  {
    $this->checkBranchOf($this->agentSlotById($agentId), $agentId, $branchId);
  }

  private function checkBranchOf(?int $slot, string $label, ?string $branchId): void
  {
    $entry = $slot === null ? [] : $this->agentSlots[$slot]['entry'];
    if ($branchId === null || ($entry['branch_id'] ?? null) === $branchId) {
      return;
    }
    foreach (ConfigWire::fields($entry['branches'] ?? null) ?? [] as $branch) {
      if (ConfigWire::get($branch, ['branch_id']) === $branchId) {
        $config = ConfigWire::get($branch, ['config']);
        if (is_string($config) && $config !== '') {
          return;
        }
        break;
      }
    }
    throw self::noBranchFile($branchId, $label);
  }

  private static function noBranchFile(string $branchId, string $label): AgentProjectError
  {
    return new AgentProjectError(
      "Branch {$branchId} of \"{$label}\" has no config file in " . self::AGENTS_FILE . '. Add it under "branches" '
        . "(the CLI's `agents pull --all-branches` does), or push the main branch"
    );
  }

  /** The entry for an agent: the one it was loaded from, else the only one with its name. */
  private function agentSlot(Agent $agent): ?int
  {
    foreach ($this->agentSlots as $i => $slot) {
      if ($slot['agent'] === $agent) {
        return $i;
      }
    }
    $matches = [];
    foreach ($this->agentSlots as $i => $slot) {
      if ($slot['agent']->name() === $agent->name()) {
        $matches[] = $i;
      }
    }
    return self::single($matches, self::AGENTS_FILE, $agent->name());
  }

  /** The entry for a tool: the one it was loaded from, else the only one with its name. */
  private function toolSlot(Tool $tool): ?int
  {
    foreach ($this->toolSlots as $i => $slot) {
      if ($slot['tool'] === $tool) {
        return $i;
      }
    }
    $matches = [];
    foreach ($this->toolSlots as $i => $slot) {
      if ($slot['tool']->name() === $tool->name()) {
        $matches[] = $i;
      }
    }
    return self::single($matches, self::TOOLS_FILE, $tool->name());
  }

  private function agentSlotById(string $id): ?int
  {
    foreach ($this->agentSlots as $i => $slot) {
      if (($slot['entry']['id'] ?? null) === $id) {
        return $i;
      }
    }
    return null;
  }

  private function toolSlotById(string $id): ?int
  {
    foreach ($this->toolSlots as $i => $slot) {
      if (($slot['entry']['id'] ?? null) === $id) {
        return $i;
      }
    }
    return null;
  }

  /**
   * @param list<int> $matches
   * @throws AgentProjectError if more than one entry matches
   */
  private static function single(array $matches, string $index, string $name): ?int
  {
    if (count($matches) > 1) {
      throw new AgentProjectError(count($matches) . " entries in {$index} are named \"{$name}\"; push the loaded one");
    }
    return $matches[0] ?? null;
  }

  private function write(string $path, string $text): void
  {
    $key = ProjectFormat::normalizePath($path);
    if (($this->files[$key] ?? null) === $text) {
      unset($this->changed[$key]);
    } else {
      $this->changed[$key] = $text;
    }
  }

  private function load(): void
  {
    $agentsIndex = $this->readIndex(self::AGENTS_FILE, 'agents');
    $toolsIndex = $this->readIndex(self::TOOLS_FILE, 'tools');

    /** @var array<string, Tool> $byId */
    $byId = [];
    foreach ($toolsIndex as $entry) {
      $raw = $this->readConfig($entry['config'] ?? null, self::TOOLS_FILE);
      try {
        $tool = Tool::fromJson($raw);
      } catch (\Throwable $e) {
        throw new AgentProjectError("{$entry['config']} isn't a valid tool config: {$e->getMessage()}", 0, $e);
      }
      $this->toolSlots[] = ['entry' => $entry, 'tool' => $tool, 'raw' => $raw, 'baseline' => self::safeJson($tool)];
      if (is_string($entry['id'] ?? null)) {
        $byId[$entry['id']] = $tool;
      }
    }
    foreach ($agentsIndex as $entry) {
      $raw = $this->readConfig($entry['config'] ?? null, self::AGENTS_FILE);
      $this->agentSlots[] = ['entry' => $entry, 'agent' => Agent::fromJson($raw, $byId)];
    }
  }

  /**
   * The entries of an index file, or none if it doesn't exist.
   *
   * @return list<array<string, mixed>>
   * @throws AgentProjectError
   */
  private function readIndex(string $path, string $key): array
  {
    $text = $this->files[$path] ?? null;
    if ($text === null) {
      return [];
    }
    try {
      $parsed = Wire::decodeJson($text);
    } catch (\JsonException $e) {
      throw new AgentProjectError("{$path} isn't valid JSON: {$e->getMessage()}", 0, $e);
    }
    $entries = ConfigWire::get($parsed, [$key]) ?? [];
    if (!is_array($entries) || !array_is_list($entries)) {
      throw new AgentProjectError("{$path} must have a \"{$key}\" list");
    }
    $out = [];
    foreach ($entries as $entry) {
      $fields = ConfigWire::fields($entry);
      if ($fields === null || !is_string($fields['config'] ?? null)) {
        throw new AgentProjectError("{$path} has an entry without a \"config\" path");
      }
      $out[] = $fields;
    }
    return $out;
  }

  /**
   * @return array<string, mixed>
   * @throws AgentProjectError
   */
  private function readConfig(mixed $path, string $index): array
  {
    $path = (string) $path;
    if (preg_match('/\.json$/i', $path) !== 1) {
      throw new AgentProjectError(
        "{$index} points at {$path}: only JSON config files are supported yet (YAML and TOML aren't)"
      );
    }
    $text = $this->files[ProjectFormat::normalizePath($path)] ?? null;
    if ($text === null) {
      throw new AgentProjectError("{$index} points at {$path}, which doesn't exist");
    }
    try {
      $parsed = Wire::decodeJson($text);
    } catch (\JsonException $e) {
      throw new AgentProjectError("{$path} isn't valid JSON: {$e->getMessage()}", 0, $e);
    }
    $fields = ConfigWire::fields($parsed);
    if ($fields === null) {
      throw new AgentProjectError("{$path} must hold a JSON object");
    }
    return $fields;
  }

  private function agentsIndex(): string
  {
    $agents = [];
    foreach ($this->agentSlots as $slot) {
      // The CLI writes fields in this order and leaves unset ones out.
      $agents[] = self::pick($slot['entry'], ['config', 'id', 'branch_id', 'version_id', 'branches']);
    }
    return ProjectFormat::formatIndex(['agents' => $agents]);
  }

  private function toolsIndex(): string
  {
    $tools = [];
    foreach ($this->toolSlots as $slot) {
      $tools[] = self::pick($slot['entry'], ['type', 'config', 'id']);
    }
    return ProjectFormat::formatIndex(['tools' => $tools]);
  }

  /**
   * @param array<string, mixed> $entry
   * @param list<string> $keys
   * @return array<string, mixed>
   */
  private static function pick(array $entry, array $keys): array
  {
    $out = [];
    foreach ($keys as $key) {
      if (array_key_exists($key, $entry) && $entry[$key] !== null) {
        $out[$key] = $entry[$key];
      }
    }
    return $out;
  }

  private static function safeJson(Tool $tool): ?string
  {
    try {
      return $tool->toJsonString();
    } catch (\Throwable) {
      return null;
    }
  }
}
