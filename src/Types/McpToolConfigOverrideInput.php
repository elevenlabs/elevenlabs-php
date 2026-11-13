<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolConfigOverrideInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the MCP tool
   */
  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * DEPRECATED: use `pre_tool_speech` instead. If set, overrides the server's force_pre_tool_speech setting for this tool.
   */
  #[JsonProperty('force_pre_tool_speech')]
  public ?bool $forcePreToolSpeech;

  /**
   * @var ?value-of<\ElevenLabs\Types\PreToolSpeechMode>
   * If set, overrides the server's pre_tool_speech setting for this tool.
   */
  #[JsonProperty('pre_tool_speech')]
  public ?string $preToolSpeech;

  /**
   * DEPRECATED: use `interruption_mode` instead. If set, overrides the server's disable_interruptions setting for this tool.
   */
  #[JsonProperty('disable_interruptions')]
  public ?bool $disableInterruptions;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolInterruptionMode>
   * If set, overrides the server's interruption_mode setting for this tool.
   */
  #[JsonProperty('interruption_mode')]
  public ?string $interruptionMode;

  /**
   * Overrides the server's tool_call_sound setting for this tool. A sound name plays that sound; 'off' overrides to no sound (silence); null means do not override (inherit the server default).
   */
  #[JsonProperty('tool_call_sound'), Union('string', 'null')]
  public ?string $toolCallSound;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>
   * If set, overrides the server's tool_call_sound_behavior setting for this tool
   */
  #[JsonProperty('tool_call_sound_behavior')]
  public ?string $toolCallSoundBehavior;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolExecutionMode>
   * If set, overrides the server's execution_mode setting for this tool
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * If set, overrides the server's response timeout for this MCP tool (seconds).
   */
  #[JsonProperty('response_timeout_secs')]
  public ?int $responseTimeoutSecs;

  /**
   * @var \ElevenLabs\Types\DynamicVariableAssignment[]|null
   * Dynamic variable assignments for this MCP tool
   */
  #[JsonProperty('assignments'), ArrayType([\ElevenLabs\Types\DynamicVariableAssignment::class])]
  public ?array $assignments;

  /**
   * @var array<string, \ElevenLabs\Types\McpToolConfigOverrideInputInputOverridesValue>|null
   * Mapping of json path to input override configuration
   */
  #[
    JsonProperty('input_overrides'),
    ArrayType(['string' => \ElevenLabs\Types\McpToolConfigOverrideInputInputOverridesValue::class])
  ]
  public ?array $inputOverrides;

  /**
   * @var \ElevenLabs\Types\ToolResponseMockConfigInput[]|null
   * Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
   */
  #[
    JsonProperty('response_mocks'),
    ArrayType([\ElevenLabs\Types\ToolResponseMockConfigInput::class])
  ]
  public ?array $responseMocks;

  /**
   * @param array{
   *   toolName: string,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   toolCallSound?: ?string,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   executionMode?: ?value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   responseTimeoutSecs?: ?int,
   *   assignments?: \ElevenLabs\Types\DynamicVariableAssignment[]|null,
   *   inputOverrides?: array<string, \ElevenLabs\Types\McpToolConfigOverrideInputInputOverridesValue>|null,
   *   responseMocks?: \ElevenLabs\Types\ToolResponseMockConfigInput[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolName = $values['toolName'];
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'] ?? null;
    $this->preToolSpeech = $values['preToolSpeech'] ?? null;
    $this->disableInterruptions = $values['disableInterruptions'] ?? null;
    $this->interruptionMode = $values['interruptionMode'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'] ?? null;
    $this->assignments = $values['assignments'] ?? null;
    $this->inputOverrides = $values['inputOverrides'] ?? null;
    $this->responseMocks = $values['responseMocks'] ?? null;

    $this->_dirtyFields = [
      'tool_name' => true
    ];
    if (array_key_exists('forcePreToolSpeech', $values)) {
      $this->_dirtyFields['force_pre_tool_speech'] = true;
    }
    if (array_key_exists('preToolSpeech', $values)) {
      $this->_dirtyFields['pre_tool_speech'] = true;
    }
    if (array_key_exists('disableInterruptions', $values)) {
      $this->_dirtyFields['disable_interruptions'] = true;
    }
    if (array_key_exists('interruptionMode', $values)) {
      $this->_dirtyFields['interruption_mode'] = true;
    }
    if (array_key_exists('toolCallSound', $values)) {
      $this->_dirtyFields['tool_call_sound'] = true;
    }
    if (array_key_exists('toolCallSoundBehavior', $values)) {
      $this->_dirtyFields['tool_call_sound_behavior'] = true;
    }
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('responseTimeoutSecs', $values)) {
      $this->_dirtyFields['response_timeout_secs'] = true;
    }
    if (array_key_exists('assignments', $values)) {
      $this->_dirtyFields['assignments'] = true;
    }
    if (array_key_exists('inputOverrides', $values)) {
      $this->_dirtyFields['input_overrides'] = true;
    }
    if (array_key_exists('responseMocks', $values)) {
      $this->_dirtyFields['response_mocks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

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

    if ($this->toolCallSound !== null) {
      $parts[] = [
        'name' => 'tool_call_sound',
        'contents' => json_encode($this->toolCallSound),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolCallSoundBehavior !== null) {
      $parts[] = [
        'name' => 'tool_call_sound_behavior',
        'contents' => $this->toolCallSoundBehavior
      ];
    }

    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->responseTimeoutSecs !== null) {
      $parts[] = [
        'name' => 'response_timeout_secs',
        'contents' => (string) $this->responseTimeoutSecs
      ];
    }

    if ($this->assignments !== null) {
      $parts[] = [
        'name' => 'assignments',
        'contents' => json_encode($this->assignments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->inputOverrides !== null) {
      $parts[] = [
        'name' => 'input_overrides',
        'contents' => json_encode($this->inputOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->responseMocks !== null) {
      $parts[] = [
        'name' => 'response_mocks',
        'contents' => json_encode($this->responseMocks),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber(
      $this->responseTimeoutSecs,
      'response_timeout_secs',
      min: 5,
      max: 300
    );
    foreach ($this->assignments ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->responseMocks ?? [] as $item) {
      $item->validate();
    }
  }
}
