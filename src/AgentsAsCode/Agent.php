<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\AgentWorkflows\Workflow;
use ElevenLabs\AgentWorkflows\WorkflowGraph;
use ElevenLabs\Agents\Requests\BodyCreateAgentV1ConvaiAgentsCreatePost;
use ElevenLabs\Types\AgentPlatformSettingsRequestModel;
use ElevenLabs\Types\ConversationalConfig;
use ElevenLabs\Types\Llm;
use ElevenLabs\Types\TtsConversationalModel;

/**
 * An agent, written as code: its settings, its tools and its workflow in one definition. Push it
 * with {@see AgentsAsCode::push()}, which creates or updates the tools and the agent together.
 *
 *     use ElevenLabs\AgentsAsCode\Agent;
 *     use ElevenLabs\AgentsAsCode\AgentsAsCode;
 *     use ElevenLabs\AgentTools\SystemTool;
 *
 *     $agent = new Agent(
 *         'Support line',
 *         prompt: 'You are a support agent for Acme.',
 *         firstMessage: 'Hi, how can I help?',
 *         tools: [SystemTool::endCall(), $getOrder],
 *         workflow: $wf,
 *     );
 *     $result = (new AgentsAsCode($client))->push($agent);
 *
 * An agent holds no client: it can be validated without an API key and pushed to several
 * workspaces.
 *
 * Hand-written (see `.fernignore`), mirroring the agent builder in the Python/TS SDKs.
 */
final class Agent
{
  /** Each typed option's API-format path. */
  private const TYPED_PATHS = [
    'prompt' => ConfigWire::PROMPT_PATH,
    'firstMessage' => ['conversation_config', 'agent', 'first_message'],
    'language' => ['conversation_config', 'agent', 'language'],
    'llm' => ['conversation_config', 'agent', 'prompt', 'llm'],
    'temperature' => ['conversation_config', 'agent', 'prompt', 'temperature'],
    'voiceId' => ['conversation_config', 'tts', 'voice_id'],
    'ttsModel' => ['conversation_config', 'tts', 'model_id'],
  ];

  private string $name;

  /** @var array<string, mixed> Typed options set, by option name, in API format. */
  private array $typed = [];

  /** @var list<string>|null */
  private ?array $tags = null;

  /** @var list<Tool> */
  private array $tools = [];

  /** @var list<string> */
  private array $toolIds = [];

  private ?Workflow $workflow = null;

  /** @var array<string, mixed>|null A loaded workflow nobody has edited yet, kept in API format so it round-trips exactly. */
  private ?array $rawWorkflow = null;

  /** @var array<string, Tool> */
  private array $toolsById = [];

  /** @var list<string> The loaded `tool_ids`, so a loaded agent keeps its tool order. */
  private array $loadedToolIds = [];

  /** Whether `tools` or `toolIds` was given (even empty), so the agent sets `tool_ids` rather than leaving it alone. */
  private bool $toolListGiven = false;

  /** @var \SplObjectStorage<Tool, array{raw: mixed, baseline: ?string}> Loaded system tools with their config as loaded. */
  private \SplObjectStorage $loadedSystem;

  /** @var array<string, mixed> Settings loaded from a config, in API format. Typed and raw options are applied on top. */
  private array $base = [];

  /** @var list<ConversationalConfig|array<string, mixed>|\stdClass> */
  private array $rawConversationConfig = [];

  /** @var list<AgentPlatformSettingsRequestModel|array<string, mixed>|\stdClass> */
  private array $rawPlatformSettings = [];

  /**
   * @param ?string $prompt The agent's instructions: `conversation_config.agent.prompt.prompt`.
   * @param ?string $firstMessage What the agent says first: `conversation_config.agent.first_message`.
   * @param ?string $language `conversation_config.agent.language`, e.g. `"en"`.
   * @param Llm|string|null $llm `conversation_config.agent.prompt.llm`.
   * @param ?float $temperature `conversation_config.agent.prompt.temperature`.
   * @param ?string $voiceId `conversation_config.tts.voice_id`.
   * @param TtsConversationalModel|string|null $ttsModel `conversation_config.tts.model_id`.
   * @param list<string>|null $tags
   * @param list<Tool>|null $tools Tools the agent can use anywhere. Webhook and client tools are
   *   created or updated by `push()` and attached by id; system tools go into `prompt.built_in_tools`.
   * @param list<string>|null $toolIds Ids of existing tools to attach as they are. `push()` doesn't
   *   create or change them.
   * @param ?Workflow $workflow The agent's workflow. Its tool nodes can take `Tool` objects, which
   *   `push()` manages too.
   * @param ConversationalConfig|array<string, mixed>|null $conversationConfig Any other conversation
   *   settings, as the generated model or an API-format (snake_case) array, merged under the typed
   *   options. Setting a field here that a typed option also sets is an `option_conflict`.
   * @param AgentPlatformSettingsRequestModel|array<string, mixed>|null $platformSettings Platform
   *   settings (privacy, evaluation, widget...), merged the same way.
   */
  public function __construct(
    string $name,
    ?string $prompt = null,
    ?string $firstMessage = null,
    ?string $language = null,
    Llm|string|null $llm = null,
    ?float $temperature = null,
    ?string $voiceId = null,
    TtsConversationalModel|string|null $ttsModel = null,
    ?array $tags = null,
    ?array $tools = null,
    ?array $toolIds = null,
    ?Workflow $workflow = null,
    ConversationalConfig|array|null $conversationConfig = null,
    AgentPlatformSettingsRequestModel|array|null $platformSettings = null,
  ) {
    $this->name = $name;
    $this->loadedSystem = new \SplObjectStorage();
    $this->update(
      prompt: $prompt,
      firstMessage: $firstMessage,
      language: $language,
      llm: $llm,
      temperature: $temperature,
      voiceId: $voiceId,
      ttsModel: $ttsModel,
      tags: $tags,
      tools: $tools,
      toolIds: $toolIds,
      workflow: $workflow,
      conversationConfig: $conversationConfig,
      platformSettings: $platformSettings,
    );
  }

  /**
   * Loads an agent config in API format (snake_case): a CLI `agent_configs/*.json` file, or the
   * `toJson()` of an agent, as a JSON string or a parsed array. Tool ids found in `$toolsById`
   * become `Tool` objects the agent manages; the rest stay as `toolIds()`. Fields this SDK doesn't
   * model are kept, so an unedited agent round-trips exactly.
   *
   * @param string|array<string, mixed> $config
   * @param array<string, Tool> $toolsById
   */
  public static function fromJson(string|array $config, array $toolsById = []): self
  {
    $parsed = is_string($config) ? Wire::decodeJson($config) : Wire::deepCopy($config);
    $base = ConfigWire::fields($parsed);
    if ($base === null) {
      throw new \InvalidArgumentException('An agent config must be a JSON object, got ' . get_debug_type($parsed));
    }
    $name = $base['name'] ?? null;
    $tags = $base['tags'] ?? null;
    $workflow = $base['workflow'] ?? null;
    unset($base['name'], $base['tags'], $base['workflow']);

    $agent = new self(is_string($name) ? $name : '');
    $agent->tags = is_array($tags) && array_is_list($tags) ? array_values(array_map('strval', $tags)) : null;
    $agent->toolsById = $toolsById;

    $ids = ConfigWire::get($base, ConfigWire::TOOL_IDS_PATH);
    if (is_array($ids) && array_is_list($ids)) {
      ConfigWire::delete($base, ConfigWire::TOOL_IDS_PATH);
      foreach ($ids as $id) {
        $id = (string) $id;
        $agent->loadedToolIds[] = $id;
        $tool = $toolsById[$id] ?? null;
        if ($tool === null) {
          $agent->toolIds[] = $id;
        } else {
          $agent->tools[] = $tool;
        }
      }
      $agent->toolListGiven = true;
    }

    // System tools become SystemTool objects, so replacing `tools` replaces them like on an agent
    // built in code.
    $builtIn = ConfigWire::fields(ConfigWire::get($base, ConfigWire::BUILT_IN_TOOLS_PATH));
    if ($builtIn !== null) {
      foreach ($builtIn as $key => $raw) {
        $fields = ConfigWire::fields($raw);
        if ($fields === null) {
          continue;
        }
        try {
          $tool = Tool::fromJson(array_merge(['type' => 'system'], $fields));
        } catch (\Throwable) {
          continue; // Kept in the config as it is.
        }
        if (!($tool instanceof SystemTool) || $tool->systemToolType() !== (string) $key) {
          continue;
        }
        $agent->tools[] = $tool;
        $agent->loadedSystem[$tool] = ['raw' => $raw, 'baseline' => self::safeJson($tool)];
        unset($builtIn[$key]);
      }
      if ($builtIn === []) {
        ConfigWire::delete($base, ConfigWire::BUILT_IN_TOOLS_PATH);
      } else {
        ConfigWire::set($base, ConfigWire::BUILT_IN_TOOLS_PATH, $builtIn);
      }
    }

    $agent->base = $base;
    $rawWorkflow = ConfigWire::fields($workflow);
    if ($rawWorkflow !== null) {
      $agent->rawWorkflow = $rawWorkflow;
    }
    return $agent;
  }

  /** The agent's name. */
  public function name(): string
  {
    return $this->name;
  }

  /**
   * The agent's workflow, or null if it has none. A loaded workflow becomes a `Workflow` the first
   * time it's read here, with its tool ids swapped for the `Tool` objects the agent knows, so it
   * can be edited.
   */
  public function workflow(): ?Workflow
  {
    if ($this->workflow === null && $this->rawWorkflow !== null) {
      $this->workflow = Workflow::fromJson($this->rawWorkflow, $this->toolsById);
      $this->rawWorkflow = null;
    }
    return $this->workflow;
  }

  /**
   * Changes the agent. Typed options, `tools`, `toolIds` and `workflow` replace what was there;
   * `conversationConfig` and `platformSettings` merge. Options left as null are unchanged.
   *
   * @param list<string>|null $tags
   * @param list<Tool>|null $tools
   * @param list<string>|null $toolIds
   * @param ConversationalConfig|array<string, mixed>|null $conversationConfig
   * @param AgentPlatformSettingsRequestModel|array<string, mixed>|null $platformSettings
   */
  public function update(
    ?string $name = null,
    ?string $prompt = null,
    ?string $firstMessage = null,
    ?string $language = null,
    Llm|string|null $llm = null,
    ?float $temperature = null,
    ?string $voiceId = null,
    TtsConversationalModel|string|null $ttsModel = null,
    ?array $tags = null,
    ?array $tools = null,
    ?array $toolIds = null,
    ?Workflow $workflow = null,
    ConversationalConfig|array|null $conversationConfig = null,
    AgentPlatformSettingsRequestModel|array|null $platformSettings = null,
  ): self {
    if ($name !== null) {
      $this->name = $name;
    }
    $typed = [
      'prompt' => $prompt,
      'firstMessage' => $firstMessage,
      'language' => $language,
      'llm' => $llm instanceof Llm ? $llm->value : $llm,
      'temperature' => $temperature,
      'voiceId' => $voiceId,
      'ttsModel' => $ttsModel instanceof TtsConversationalModel ? $ttsModel->value : $ttsModel,
    ];
    foreach ($typed as $key => $value) {
      if ($value !== null) {
        $this->typed[$key] = $value;
      }
    }
    if ($tags !== null) {
      $this->tags = array_values($tags);
    }
    if ($tools !== null) {
      $this->tools = array_values($tools);
      $this->toolListGiven = true;
    }
    if ($toolIds !== null) {
      $this->toolIds = array_values($toolIds);
      $this->toolListGiven = true;
    }
    if ($workflow !== null) {
      $this->workflow = $workflow;
      $this->rawWorkflow = null;
    }
    if ($conversationConfig !== null) {
      $this->rawConversationConfig[] = $conversationConfig;
    }
    if ($platformSettings !== null) {
      $this->rawPlatformSettings[] = $platformSettings;
    }
    return $this;
  }

  /** Adds a tool the agent can use anywhere. */
  public function addTool(Tool $tool): self
  {
    $this->tools[] = $tool;
    $this->toolListGiven = true;
    return $this;
  }

  /**
   * Every webhook and client tool the agent and its workflow use, each once, in first-use order:
   * the tools `push()` creates or updates. System tools aren't included; they live inside the
   * agent's config.
   *
   * @return list<Tool>
   */
  public function tools(): array
  {
    $seen = new \SplObjectStorage();
    $out = [];
    foreach (array_merge($this->tools, $this->workflowTools()) as $tool) {
      if ($tool instanceof SystemTool || isset($seen[$tool])) {
        continue;
      }
      $seen[$tool] = true;
      $out[] = $tool;
    }
    return $out;
  }

  /**
   * The ids of existing tools attached as they are, which `push()` doesn't manage.
   *
   * @return list<string>
   */
  public function toolIds(): array
  {
    return $this->toolIds;
  }

  /**
   * Checks everything that doesn't need tool ids: the tools, the workflow, the settings, and that
   * no two tools share a name. CI can run this without an API key.
   *
   * @param null|callable(AgentIssue): mixed $onWarning Called for each non-fatal problem, such as
   *   an agent without a prompt.
   * @throws AgentValidationError listing every problem, if the agent is invalid
   */
  public function validate(?callable $onWarning = null): void
  {
    $this->assemble(null, $onWarning);
  }

  /**
   * The agent config in API format (snake_case keys, sorted at every level): the shape of a CLI
   * `agent_configs/*.json` file. Validates like `validate()`, and also needs every managed tool's
   * id.
   *
   * @param array<string, string> $toolIds The id of each webhook and client tool the agent uses,
   *   by tool name. `push()` passes these after creating or updating the tools.
   * @param null|callable(AgentIssue): mixed $onWarning
   * @return array<string, mixed>
   * @throws AgentValidationError
   */
  public function toJson(array $toolIds = [], ?callable $onWarning = null): array
  {
    return $this->assemble($toolIds, $onWarning);
  }

  /**
   * `toJson()` parsed into the request `agents->create()` accepts. Fields this SDK doesn't model
   * are kept only as the model's additional properties; `push()` sends the whole `toJson()`.
   *
   * @param array<string, string> $toolIds
   * @param null|callable(AgentIssue): mixed $onWarning
   * @throws AgentValidationError
   */
  public function build(array $toolIds = [], ?callable $onWarning = null): BodyCreateAgentV1ConvaiAgentsCreatePost
  {
    return BodyCreateAgentV1ConvaiAgentsCreatePost::fromJson(
      json_encode($this->toJson($toolIds, $onWarning), JSON_THROW_ON_ERROR)
    );
  }

  /**
   * @return list<Tool>
   */
  private function workflowTools(): array
  {
    if ($this->workflow !== null) {
      return $this->workflow->tools();
    }
    $tools = [];
    foreach (ConfigWire::workflowToolIds($this->rawWorkflow) as $id) {
      if (isset($this->toolsById[$id])) {
        $tools[] = $this->toolsById[$id];
      }
    }
    return $tools;
  }

  /**
   * Builds the API-format config. Without `$toolIds` (validation only), tools stand under
   * placeholder ids and missing ids aren't reported.
   *
   * @param array<string, string>|null $toolIds
   * @param null|callable(AgentIssue): mixed $onWarning
   * @return array<string, mixed>
   */
  private function assemble(?array $toolIds, ?callable $onWarning): array
  {
    /** @var list<AgentIssue> $issues */
    $issues = [];
    /** @var array<string, mixed> $config */
    $config = Wire::deepCopy($this->base);
    $idOf = static fn(Tool $tool): string => $toolIds[$tool->name()] ?? WorkflowGraph::toolPlaceholder($tool->name());

    if (trim($this->name) === '') {
      $issues[] = new AgentIssue('missing_name', 'error', 'The agent needs a name');
    }

    // Raw options first, so the typed ones win and can be checked against them.
    $raw = [];
    foreach ($this->rawConversationConfig as $settings) {
      $wire = self::rawWire($settings);
      if ($wire instanceof \Throwable) {
        $issues[] = self::invalidConfig('conversationConfig', $wire);
      } else {
        ConfigWire::deepMerge($raw, ['conversation_config' => $wire]);
      }
    }
    foreach ($this->rawPlatformSettings as $settings) {
      $wire = self::rawWire($settings);
      if ($wire instanceof \Throwable) {
        $issues[] = self::invalidConfig('platformSettings', $wire);
      } else {
        ConfigWire::deepMerge($raw, ['platform_settings' => $wire]);
      }
    }
    ConfigWire::deepMerge($config, $raw);

    foreach ($this->typed as $key => $value) {
      $path = self::TYPED_PATHS[$key];
      if (ConfigWire::has($raw, $path)) {
        $issues[] = self::conflict($key, $path);
      }
      ConfigWire::set($config, $path, $value);
    }

    // Tools: every one validates, and no two different tools share a name.
    /** @var array<string, Tool> $byName */
    $byName = [];
    foreach (array_merge($this->tools, $this->workflowTools()) as $tool) {
      $other = $byName[$tool->name()] ?? null;
      if ($other !== null && $other !== $tool) {
        $issues[] = new AgentIssue(
          'duplicate_tool_name',
          'error',
          "Two different tools are named \"{$tool->name()}\"",
          "tools.{$tool->name()}",
        );
      }
      if ($other === null) {
        $byName[$tool->name()] = $tool;
        try {
          $tool->buildConfig();
        } catch (\Throwable $e) {
          $issues[] = new AgentIssue('invalid_tool', 'error', $e->getMessage(), "tools.{$tool->name()}");
        }
      }
    }

    $managed = [];
    $system = [];
    foreach ($this->tools as $tool) {
      if ($tool instanceof SystemTool) {
        $system[] = $tool;
      } else {
        $managed[] = $tool;
      }
    }
    if ($this->toolListGiven) {
      if (ConfigWire::has($raw, ConfigWire::TOOL_IDS_PATH)) {
        $issues[] = self::conflict('tools', ConfigWire::TOOL_IDS_PATH);
      }
      ConfigWire::set(
        $config,
        ConfigWire::TOOL_IDS_PATH,
        self::keepOrder(array_merge($this->toolIds, array_map($idOf, $managed)), $this->loadedToolIds),
      );
    }
    foreach ($system as $tool) {
      $path = array_merge(ConfigWire::BUILT_IN_TOOLS_PATH, [$tool->systemToolType()]);
      if (ConfigWire::has($raw, $path)) {
        $issues[] = self::conflict('tools', $path);
      }
      $loaded = isset($this->loadedSystem[$tool]) ? $this->loadedSystem[$tool] : null;
      if ($loaded !== null && $loaded['baseline'] !== null && self::safeJson($tool) === $loaded['baseline']) {
        ConfigWire::set($config, $path, Wire::deepCopy($loaded['raw']));
        continue;
      }
      try {
        ConfigWire::set($config, $path, $tool->toJson());
      } catch (\Throwable) {
        // Reported as invalid_tool above.
      }
    }

    // Workflow: its own checks, plus tool nodes can only run webhook and client tools.
    if ($this->workflow !== null) {
      $wf = $this->workflow;
      $ids = [];
      foreach ($wf->tools() as $tool) {
        if ($tool instanceof SystemTool) {
          $issues[] = new AgentIssue(
            'system_tool_in_workflow',
            'error',
            "System tool \"{$tool->name()}\" can't be used in a workflow node; add it to the agent's tools",
            "workflow.tools.{$tool->name()}",
          );
        }
        $ids[$tool->name()] = $idOf($tool);
      }
      try {
        $config['workflow'] = $wf->toJson($ids);
      } catch (\Throwable $e) {
        $issues[] = new AgentIssue('invalid_workflow', 'error', $e->getMessage(), 'workflow');
      }
    } elseif ($this->rawWorkflow !== null) {
      // Check the loaded graph without replacing the raw copy, which keeps fields this SDK doesn't model.
      try {
        Workflow::fromJson($this->rawWorkflow)->toJson();
      } catch (\Throwable $e) {
        $issues[] = new AgentIssue('invalid_workflow', 'error', $e->getMessage(), 'workflow');
      }
      // Its managed tools may have new ids, e.g. when pushed as a new agent.
      $byId = $this->toolsById;
      /** @var array<string, mixed> $copy */
      $copy = Wire::deepCopy($this->rawWorkflow);
      $config['workflow'] = ConfigWire::mapWorkflowToolIds(
        $copy,
        static function (string $id) use ($byId, $toolIds): string {
          $tool = $byId[$id] ?? null;
          return $tool === null ? $id : ($toolIds[$tool->name()] ?? $id);
        },
      );
    }

    if ($toolIds !== null) {
      foreach ($this->tools() as $tool) {
        if (!isset($toolIds[$tool->name()])) {
          $issues[] = new AgentIssue(
            'unresolved_tool',
            'error',
            "Tool \"{$tool->name()}\" has no id yet. Push the agent with AgentsAsCode::push(), or pass toolIds",
            "tools.{$tool->name()}",
          );
        }
      }
    }

    if (!is_string(ConfigWire::get($config, ConfigWire::PROMPT_PATH))) {
      $issues[] = new AgentIssue(
        'missing_prompt',
        'warning',
        'The agent needs a prompt',
        'conversation_config.agent.prompt.prompt',
      );
    }

    $unique = self::dedupe($issues);
    $errors = array_values(array_filter($unique, static fn(AgentIssue $i): bool => $i->severity === 'error'));
    if ($errors !== []) {
      throw new AgentValidationError($this->name, $errors);
    }
    if ($onWarning !== null) {
      foreach ($unique as $issue) {
        if ($issue->severity === 'warning') {
          $onWarning($issue);
        }
      }
    }

    $config['name'] = $this->name;
    foreach (['conversation_config', 'platform_settings'] as $key) {
      if (!array_key_exists($key, $config) || $config[$key] === null || $config[$key] === []) {
        $config[$key] = new \stdClass();
      }
    }
    $config['tags'] = $this->tags ?? [];
    /** @var array<string, mixed> $canonical */
    $canonical = Wire::canonical($config);
    return $canonical;
  }

  /**
   * A raw option in API format, or the error that stopped it serializing.
   *
   * @param ConversationalConfig|AgentPlatformSettingsRequestModel|array<string, mixed>|\stdClass $settings
   * @return array<string, mixed>|\Throwable
   */
  private static function rawWire(mixed $settings): array|\Throwable
  {
    try {
      $wire = Wire::toWire($settings);
      if ($wire instanceof \stdClass || $wire === []) {
        return [];
      }
      $fields = ConfigWire::fields($wire);
      if ($fields === null) {
        return new \InvalidArgumentException('expected an object, got ' . get_debug_type($wire));
      }
      json_encode($fields, JSON_THROW_ON_ERROR);
      return $fields;
    } catch (\Throwable $e) {
      return $e;
    }
  }

  /**
   * `$ids` with the ones in `$loaded` first, in that order, then the rest as they are.
   *
   * @param list<string> $ids
   * @param list<string> $loaded
   * @return list<string>
   */
  private static function keepOrder(array $ids, array $loaded): array
  {
    $rank = array_flip(array_reverse($loaded, true));
    $ranked = [];
    foreach ($ids as $i => $id) {
      $ranked[] = [$rank[$id] ?? count($loaded), $i, $id];
    }
    usort($ranked, static fn(array $a, array $b): int => [$a[0], $a[1]] <=> [$b[0], $b[1]]);
    return array_map(static fn(array $entry): string => $entry[2], $ranked);
  }

  private static function safeJson(Tool $tool): ?string
  {
    try {
      return $tool->toJsonString();
    } catch (\Throwable) {
      return null;
    }
  }

  private static function invalidConfig(string $option, \Throwable $e): AgentIssue
  {
    return new AgentIssue('invalid_config', 'error', "Invalid {$option}: {$e->getMessage()}", $option);
  }

  /**
   * @param list<string> $path
   */
  private static function conflict(string $option, array $path): AgentIssue
  {
    $joined = implode('.', $path);
    return new AgentIssue(
      'option_conflict',
      'error',
      "\"{$option}\" and the raw config both set {$joined}; set it in one place",
      $joined,
    );
  }

  /**
   * @param list<AgentIssue> $issues
   * @return list<AgentIssue>
   */
  private static function dedupe(array $issues): array
  {
    $seen = [];
    $out = [];
    foreach ($issues as $issue) {
      $key = "{$issue->code}|{$issue->path}|{$issue->message}";
      if (!isset($seen[$key])) {
        $seen[$key] = true;
        $out[] = $issue;
      }
    }
    return $out;
  }
}
