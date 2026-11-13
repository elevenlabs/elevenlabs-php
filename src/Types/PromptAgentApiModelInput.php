<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PromptAgentApiModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The prompt for the agent
   */
  #[JsonProperty('prompt')]
  public ?string $prompt;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmReasoningEffort>
   * Reasoning effort of the model. Only available for some models.
   */
  #[JsonProperty('reasoning_effort')]
  public ?string $reasoningEffort;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmServiceTier>
   * Request-time processing tier for a model.
   *
   * STANDARD: default price and throughput.
   * FAST: pays a per-token price premium for higher throughput / lower latency.
   *     See OpenAI's fast mode: https://openai.com/api-fast-mode/
   */
  #[JsonProperty('service_tier')]
  public ?string $serviceTier;

  /**
   * Max number of tokens used for thinking. Use 0 to turn off if supported by the model.
   */
  #[JsonProperty('thinking_budget')]
  public ?int $thinkingBudget;

  /**
   * Enable model reasoning summaries. When disabled, we do not request summaries from provider if possible for faster TTFB. Not ZRM compatible.
   */
  #[JsonProperty('enable_reasoning_summary')]
  public ?bool $enableReasoningSummary;

  /**
   * The temperature for the LLM. Defaults to 0. Set to null to omit the parameter from the LLM request entirely (useful for custom LLMs that reject the temperature field).
   */
  #[JsonProperty('temperature')]
  public ?float $temperature;

  /**
   * If greater than 0, maximum number of tokens the LLM can predict
   */
  #[JsonProperty('max_tokens')]
  public ?int $maxTokens;

  /**
   * @var string[]|null
   * A list of IDs of tools used by the agent
   */
  #[JsonProperty('tool_ids'), ArrayType(['string'])]
  public ?array $toolIds;

  /**
   * Only applies as a conversation override, allowed whenever tool_ids may be overridden. When true, the overridden tool_ids is the full list of tools allowed in the conversation, including tools on workflow nodes. Ignored when set on the agent.
   */
  #[JsonProperty('tool_ids_strict')]
  public ?bool $toolIdsStrict;

  /**
   * System tools a conversational agent can be given.
   *
   * Deliberately not named ConversationalBuiltInTools: BuiltInToolsInput and
   * BuiltInToolsOutput are part of the public API spec and the generated SDKs.
   */
  #[JsonProperty('built_in_tools')]
  public ?\ElevenLabs\Types\BuiltInToolsInput $builtInTools;

  /**
   * Enable parallel tool calling. When enabled, the agent can execute multiple tools in parallel within a single turn. Not supported by all models.
   */
  #[JsonProperty('enable_parallel_tool_calls')]
  public ?bool $enableParallelToolCalls;

  /**
   * @var string[]|null
   * A list of MCP server ids to be used by the agent
   */
  #[JsonProperty('mcp_server_ids'), ArrayType(['string'])]
  public ?array $mcpServerIds;

  /**
   * @var string[]|null
   * A list of Native MCP server ids to be used by the agent
   */
  #[JsonProperty('native_mcp_server_ids'), ArrayType(['string'])]
  public ?array $nativeMcpServerIds;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]|null
   * A list of knowledge bases to be used by the agent
   */
  #[JsonProperty('knowledge_base'), ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])]
  public ?array $knowledgeBase;

  /**
   * Definition for a custom LLM if LLM field is set to 'CUSTOM_LLM'
   */
  #[JsonProperty('custom_llm')]
  public ?\ElevenLabs\Types\CustomLlm $customLlm;

  /**
   * Whether to remove the default personality lines from the system prompt
   */
  #[JsonProperty('ignore_default_personality')]
  public ?bool $ignoreDefaultPersonality;

  #[JsonProperty('rag')]
  public ?\ElevenLabs\Types\RagConfigInput $rag;

  /**
   * Timezone for displaying current time in system prompt. If set, the current time will be included in the system prompt using this timezone. Must be a valid timezone name (e.g., 'America/New_York', 'Europe/London', 'UTC'). Recommended for accurate time-aware responses; without this, the agent has no knowledge of the current date/time unless you provide it via dynamic variables or tools, which can lead to incorrect or hallucinated time references.
   */
  #[JsonProperty('timezone')]
  public ?string $timezone;

  /**
   * Configuration for backup LLM cascading. Can be disabled, use system defaults, or specify custom order.
   */
  #[JsonProperty('backup_llm_config')]
  public ?\ElevenLabs\Types\PromptAgentApiModelInputBackupLlmConfig $backupLlmConfig;

  /**
   * Time in seconds before cascading to backup LLM. Must be between 2 and 15 seconds.
   */
  #[JsonProperty('cascade_timeout_seconds')]
  public ?float $cascadeTimeoutSeconds;

  /**
   * @var \ElevenLabs\Types\PromptAgentApiModelInputToolsItem[]|null
   * A list of tools that the agent can use over the course of the conversation, use tool_ids instead
   */
  #[JsonProperty('tools'), ArrayType([\ElevenLabs\Types\PromptAgentApiModelInputToolsItem::class])]
  public ?array $tools;

  /**
   * @param array{
   *   prompt?: ?string,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   reasoningEffort?: ?value-of<\ElevenLabs\Types\LlmReasoningEffort>,
   *   serviceTier?: ?value-of<\ElevenLabs\Types\LlmServiceTier>,
   *   thinkingBudget?: ?int,
   *   enableReasoningSummary?: ?bool,
   *   temperature?: ?float,
   *   maxTokens?: ?int,
   *   toolIds?: string[]|null,
   *   toolIdsStrict?: ?bool,
   *   builtInTools?: ?\ElevenLabs\Types\BuiltInToolsInput,
   *   enableParallelToolCalls?: ?bool,
   *   mcpServerIds?: string[]|null,
   *   nativeMcpServerIds?: string[]|null,
   *   knowledgeBase?: \ElevenLabs\Types\KnowledgeBaseLocator[]|null,
   *   customLlm?: ?\ElevenLabs\Types\CustomLlm,
   *   ignoreDefaultPersonality?: ?bool,
   *   rag?: ?\ElevenLabs\Types\RagConfigInput,
   *   timezone?: ?string,
   *   backupLlmConfig?: ?\ElevenLabs\Types\PromptAgentApiModelInputBackupLlmConfig,
   *   cascadeTimeoutSeconds?: ?float,
   *   tools?: \ElevenLabs\Types\PromptAgentApiModelInputToolsItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->prompt = $values['prompt'] ?? null;
    $this->llm = $values['llm'] ?? null;
    $this->reasoningEffort = $values['reasoningEffort'] ?? null;
    $this->serviceTier = $values['serviceTier'] ?? null;
    $this->thinkingBudget = $values['thinkingBudget'] ?? null;
    $this->enableReasoningSummary = $values['enableReasoningSummary'] ?? null;
    $this->temperature = $values['temperature'] ?? null;
    $this->maxTokens = $values['maxTokens'] ?? null;
    $this->toolIds = $values['toolIds'] ?? null;
    $this->toolIdsStrict = $values['toolIdsStrict'] ?? null;
    $this->builtInTools = $values['builtInTools'] ?? null;
    $this->enableParallelToolCalls = $values['enableParallelToolCalls'] ?? null;
    $this->mcpServerIds = $values['mcpServerIds'] ?? null;
    $this->nativeMcpServerIds = $values['nativeMcpServerIds'] ?? null;
    $this->knowledgeBase = $values['knowledgeBase'] ?? null;
    $this->customLlm = $values['customLlm'] ?? null;
    $this->ignoreDefaultPersonality = $values['ignoreDefaultPersonality'] ?? null;
    $this->rag = $values['rag'] ?? null;
    $this->timezone = $values['timezone'] ?? null;
    $this->backupLlmConfig = $values['backupLlmConfig'] ?? null;
    $this->cascadeTimeoutSeconds = $values['cascadeTimeoutSeconds'] ?? null;
    $this->tools = $values['tools'] ?? null;

    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('reasoningEffort', $values)) {
      $this->_dirtyFields['reasoning_effort'] = true;
    }
    if (array_key_exists('serviceTier', $values)) {
      $this->_dirtyFields['service_tier'] = true;
    }
    if (array_key_exists('thinkingBudget', $values)) {
      $this->_dirtyFields['thinking_budget'] = true;
    }
    if (array_key_exists('enableReasoningSummary', $values)) {
      $this->_dirtyFields['enable_reasoning_summary'] = true;
    }
    if (array_key_exists('temperature', $values)) {
      $this->_dirtyFields['temperature'] = true;
    }
    if (array_key_exists('maxTokens', $values)) {
      $this->_dirtyFields['max_tokens'] = true;
    }
    if (array_key_exists('toolIds', $values)) {
      $this->_dirtyFields['tool_ids'] = true;
    }
    if (array_key_exists('toolIdsStrict', $values)) {
      $this->_dirtyFields['tool_ids_strict'] = true;
    }
    if (array_key_exists('builtInTools', $values)) {
      $this->_dirtyFields['built_in_tools'] = true;
    }
    if (array_key_exists('enableParallelToolCalls', $values)) {
      $this->_dirtyFields['enable_parallel_tool_calls'] = true;
    }
    if (array_key_exists('mcpServerIds', $values)) {
      $this->_dirtyFields['mcp_server_ids'] = true;
    }
    if (array_key_exists('nativeMcpServerIds', $values)) {
      $this->_dirtyFields['native_mcp_server_ids'] = true;
    }
    if (array_key_exists('knowledgeBase', $values)) {
      $this->_dirtyFields['knowledge_base'] = true;
    }
    if (array_key_exists('customLlm', $values)) {
      $this->_dirtyFields['custom_llm'] = true;
    }
    if (array_key_exists('ignoreDefaultPersonality', $values)) {
      $this->_dirtyFields['ignore_default_personality'] = true;
    }
    if (array_key_exists('rag', $values)) {
      $this->_dirtyFields['rag'] = true;
    }
    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
    if (array_key_exists('backupLlmConfig', $values)) {
      $this->_dirtyFields['backup_llm_config'] = true;
    }
    if (array_key_exists('cascadeTimeoutSeconds', $values)) {
      $this->_dirtyFields['cascade_timeout_seconds'] = true;
    }
    if (array_key_exists('tools', $values)) {
      $this->_dirtyFields['tools'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->reasoningEffort !== null) {
      $parts[] = [
        'name' => 'reasoning_effort',
        'contents' => $this->reasoningEffort
      ];
    }

    if ($this->serviceTier !== null) {
      $parts[] = [
        'name' => 'service_tier',
        'contents' => $this->serviceTier
      ];
    }

    if ($this->thinkingBudget !== null) {
      $parts[] = [
        'name' => 'thinking_budget',
        'contents' => (string) $this->thinkingBudget
      ];
    }

    if ($this->enableReasoningSummary !== null) {
      $parts[] = [
        'name' => 'enable_reasoning_summary',
        'contents' => $this->enableReasoningSummary ? 'true' : 'false'
      ];
    }

    if ($this->temperature !== null) {
      $parts[] = [
        'name' => 'temperature',
        'contents' => (string) $this->temperature
      ];
    }

    if ($this->maxTokens !== null) {
      $parts[] = [
        'name' => 'max_tokens',
        'contents' => (string) $this->maxTokens
      ];
    }

    if ($this->toolIds !== null) {
      foreach ($this->toolIds ?? [] as $item) {
        $parts[] = [
          'name' => 'tool_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->toolIdsStrict !== null) {
      $parts[] = [
        'name' => 'tool_ids_strict',
        'contents' => $this->toolIdsStrict ? 'true' : 'false'
      ];
    }

    if ($this->builtInTools !== null) {
      $parts[] = [
        'name' => 'built_in_tools',
        'contents' => json_encode($this->builtInTools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->enableParallelToolCalls !== null) {
      $parts[] = [
        'name' => 'enable_parallel_tool_calls',
        'contents' => $this->enableParallelToolCalls ? 'true' : 'false'
      ];
    }

    if ($this->mcpServerIds !== null) {
      foreach ($this->mcpServerIds ?? [] as $item) {
        $parts[] = [
          'name' => 'mcp_server_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->nativeMcpServerIds !== null) {
      foreach ($this->nativeMcpServerIds ?? [] as $item) {
        $parts[] = [
          'name' => 'native_mcp_server_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->knowledgeBase !== null) {
      $parts[] = [
        'name' => 'knowledge_base',
        'contents' => json_encode($this->knowledgeBase),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->customLlm !== null) {
      $parts[] = [
        'name' => 'custom_llm',
        'contents' => json_encode($this->customLlm),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->ignoreDefaultPersonality !== null) {
      $parts[] = [
        'name' => 'ignore_default_personality',
        'contents' => $this->ignoreDefaultPersonality ? 'true' : 'false'
      ];
    }

    if ($this->rag !== null) {
      $parts[] = [
        'name' => 'rag',
        'contents' => json_encode($this->rag),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    if ($this->backupLlmConfig !== null) {
      $parts[] = [
        'name' => 'backup_llm_config',
        'contents' => json_encode($this->backupLlmConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->cascadeTimeoutSeconds !== null) {
      $parts[] = [
        'name' => 'cascade_timeout_seconds',
        'contents' => (string) $this->cascadeTimeoutSeconds
      ];
    }

    if ($this->tools !== null) {
      $parts[] = [
        'name' => 'tools',
        'contents' => json_encode($this->tools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->builtInTools?->validate();
    Validator::validateArray($this->mcpServerIds, 'mcp_server_ids', maxItems: 10);
    Validator::validateArray($this->nativeMcpServerIds, 'native_mcp_server_ids', maxItems: 10);
    foreach ($this->knowledgeBase ?? [] as $item) {
      $item->validate();
    }
    $this->customLlm?->validate();
    $this->rag?->validate();
    Validator::validateNumber(
      $this->cascadeTimeoutSeconds,
      'cascade_timeout_seconds',
      min: 2,
      max: 15
    );
  }
}
