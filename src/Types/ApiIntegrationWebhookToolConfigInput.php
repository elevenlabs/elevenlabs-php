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
class ApiIntegrationWebhookToolConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ApiIntegrationWebhookToolConfigInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Description of when the tool should be used and what it does.
   */
  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * The maximum time in seconds to wait for the tool call to complete. Must be between 5 and 300 seconds (inclusive).
   */
  #[JsonProperty('response_timeout_secs')]
  public ?int $responseTimeoutSecs;

  /**
   * DEPRECATED: use `interruption_mode` instead. If true, the user will not be able to interrupt the agent while this tool is running.
   */
  #[JsonProperty('disable_interruptions')]
  public ?bool $disableInterruptions;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolInterruptionMode>
   */
  #[JsonProperty('interruption_mode')]
  public ?string $interruptionMode;

  /**
   * DEPRECATED: use `pre_tool_speech` instead. If true, the agent will speak before the tool call.
   */
  #[JsonProperty('force_pre_tool_speech')]
  public ?bool $forcePreToolSpeech;

  /**
   * @var ?value-of<\ElevenLabs\Types\PreToolSpeechMode>
   */
  #[JsonProperty('pre_tool_speech')]
  public ?string $preToolSpeech;

  /**
   * @var \ElevenLabs\Types\DynamicVariableAssignment[]|null
   * Configuration for extracting values from tool responses and assigning them to dynamic variables
   */
  #[JsonProperty('assignments'), ArrayType([\ElevenLabs\Types\DynamicVariableAssignment::class])]
  public ?array $assignments;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundType>
   * Predefined tool call sound type to play during tool execution. If not specified, no tool call sound will be played.
   */
  #[JsonProperty('tool_call_sound')]
  public ?string $toolCallSound;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>
   * Determines how the tool call sound should be played.
   */
  #[JsonProperty('tool_call_sound_behavior')]
  public ?string $toolCallSoundBehavior;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolErrorHandlingMode>
   * Controls how tool errors are processed before being shared with the agent.
   */
  #[JsonProperty('tool_error_handling_mode')]
  public ?string $toolErrorHandlingMode;

  #[JsonProperty('dynamic_variables')]
  public ?\ElevenLabs\Types\DynamicVariablesConfig $dynamicVariables;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolExecutionMode>
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * The version of the API integration tool
   */
  #[JsonProperty('tool_version')]
  public ?string $toolVersion;

  #[JsonProperty('api_integration_id', required: true)]
  public string $apiIntegrationId;

  #[JsonProperty('api_integration_connection_id', required: true)]
  public string $apiIntegrationConnectionId;

  /**
   * User overrides applied on top of the base api_schema
   */
  #[JsonProperty('api_schema_overrides')]
  public ?\ElevenLabs\Types\ApiIntegrationWebhookOverrides $apiSchemaOverrides;

  /**
   * @param array{
   *   name: string,
   *   description: string,
   *   apiIntegrationId: string,
   *   apiIntegrationConnectionId: string,
   *   type?: ?value-of<\ElevenLabs\Types\ApiIntegrationWebhookToolConfigInputType>,
   *   responseTimeoutSecs?: ?int,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   assignments?: \ElevenLabs\Types\DynamicVariableAssignment[]|null,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   toolErrorHandlingMode?: ?value-of<\ElevenLabs\Types\ToolErrorHandlingMode>,
   *   dynamicVariables?: ?\ElevenLabs\Types\DynamicVariablesConfig,
   *   executionMode?: ?value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   toolVersion?: ?string,
   *   apiSchemaOverrides?: ?\ElevenLabs\Types\ApiIntegrationWebhookOverrides,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'api_integration_webhook';
    $this->name = $values['name'];
    $this->description = $values['description'];
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'] ?? null;
    $this->disableInterruptions = $values['disableInterruptions'] ?? null;
    $this->interruptionMode = $values['interruptionMode'] ?? null;
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'] ?? null;
    $this->preToolSpeech = $values['preToolSpeech'] ?? null;
    $this->assignments = $values['assignments'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'] ?? null;
    $this->toolErrorHandlingMode = $values['toolErrorHandlingMode'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->toolVersion = $values['toolVersion'] ?? null;
    $this->apiIntegrationId = $values['apiIntegrationId'];
    $this->apiIntegrationConnectionId = $values['apiIntegrationConnectionId'];
    $this->apiSchemaOverrides = $values['apiSchemaOverrides'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'description' => true,
      'api_integration_id' => true,
      'api_integration_connection_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('responseTimeoutSecs', $values)) {
      $this->_dirtyFields['response_timeout_secs'] = true;
    }
    if (array_key_exists('disableInterruptions', $values)) {
      $this->_dirtyFields['disable_interruptions'] = true;
    }
    if (array_key_exists('interruptionMode', $values)) {
      $this->_dirtyFields['interruption_mode'] = true;
    }
    if (array_key_exists('forcePreToolSpeech', $values)) {
      $this->_dirtyFields['force_pre_tool_speech'] = true;
    }
    if (array_key_exists('preToolSpeech', $values)) {
      $this->_dirtyFields['pre_tool_speech'] = true;
    }
    if (array_key_exists('assignments', $values)) {
      $this->_dirtyFields['assignments'] = true;
    }
    if (array_key_exists('toolCallSound', $values)) {
      $this->_dirtyFields['tool_call_sound'] = true;
    }
    if (array_key_exists('toolCallSoundBehavior', $values)) {
      $this->_dirtyFields['tool_call_sound_behavior'] = true;
    }
    if (array_key_exists('toolErrorHandlingMode', $values)) {
      $this->_dirtyFields['tool_error_handling_mode'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('toolVersion', $values)) {
      $this->_dirtyFields['tool_version'] = true;
    }
    if (array_key_exists('apiSchemaOverrides', $values)) {
      $this->_dirtyFields['api_schema_overrides'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->responseTimeoutSecs !== null) {
      $parts[] = [
        'name' => 'response_timeout_secs',
        'contents' => (string) $this->responseTimeoutSecs
      ];
    }

    if ($this->disableInterruptions !== null) {
      $parts[] = [
        'name' => 'disable_interruptions',
        'contents' => $this->disableInterruptions ? 'true' : 'false'
      ];
    }

    if ($this->interruptionMode !== null) {
      $parts[] = [
        'name' => 'interruption_mode',
        'contents' => $this->interruptionMode
      ];
    }

    if ($this->forcePreToolSpeech !== null) {
      $parts[] = [
        'name' => 'force_pre_tool_speech',
        'contents' => $this->forcePreToolSpeech ? 'true' : 'false'
      ];
    }

    if ($this->preToolSpeech !== null) {
      $parts[] = [
        'name' => 'pre_tool_speech',
        'contents' => $this->preToolSpeech
      ];
    }

    if ($this->assignments !== null) {
      $parts[] = [
        'name' => 'assignments',
        'contents' => json_encode($this->assignments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolCallSound !== null) {
      $parts[] = [
        'name' => 'tool_call_sound',
        'contents' => $this->toolCallSound
      ];
    }

    if ($this->toolCallSoundBehavior !== null) {
      $parts[] = [
        'name' => 'tool_call_sound_behavior',
        'contents' => $this->toolCallSoundBehavior
      ];
    }

    if ($this->toolErrorHandlingMode !== null) {
      $parts[] = [
        'name' => 'tool_error_handling_mode',
        'contents' => $this->toolErrorHandlingMode
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->toolVersion !== null) {
      $parts[] = [
        'name' => 'tool_version',
        'contents' => $this->toolVersion
      ];
    }

    $parts[] = [
      'name' => 'api_integration_id',
      'contents' => $this->apiIntegrationId
    ];

    $parts[] = [
      'name' => 'api_integration_connection_id',
      'contents' => $this->apiIntegrationConnectionId
    ];

    if ($this->apiSchemaOverrides !== null) {
      $parts[] = [
        'name' => 'api_schema_overrides',
        'contents' => json_encode($this->apiSchemaOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 0, pattern: '^[a-zA-Z0-9_-]{1,64}$');
    Validator::validateString($this->description, 'description', minLength: 0);
    Validator::validateNumber(
      $this->responseTimeoutSecs,
      'response_timeout_secs',
      min: 5,
      max: 300
    );
    foreach ($this->assignments ?? [] as $item) {
      $item->validate();
    }
    $this->dynamicVariables?->validate();
    $this->apiSchemaOverrides?->validate();
  }
}
