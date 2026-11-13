<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * SMB tool configuration that wraps SMB tool parameters.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SmbToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SmbToolConfigType>
   * Tool type identifier
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Description of when the tool should be used and what it does.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * The maximum time in seconds to wait for the tool call to complete.
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

  /**
   * User-facing tooltip for the procedure reference picker. Not sent to the LLM.
   */
  #[JsonProperty('human_description')]
  public ?string $humanDescription;

  /**
   * Whether this tool is enabled for the agent
   */
  #[JsonProperty('enabled')]
  public ?bool $enabled;

  #[JsonProperty('params', required: true)]
  public \ElevenLabs\Types\SmbToolConfigParams $params;

  /**
   * @param array{
   *   name: string,
   *   params: \ElevenLabs\Types\SmbToolConfigParams,
   *   type?: ?value-of<\ElevenLabs\Types\SmbToolConfigType>,
   *   description?: ?string,
   *   responseTimeoutSecs?: ?int,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   assignments?: \ElevenLabs\Types\DynamicVariableAssignment[]|null,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   toolErrorHandlingMode?: ?value-of<\ElevenLabs\Types\ToolErrorHandlingMode>,
   *   humanDescription?: ?string,
   *   enabled?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'smb';
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'] ?? null;
    $this->disableInterruptions = $values['disableInterruptions'] ?? null;
    $this->interruptionMode = $values['interruptionMode'] ?? null;
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'] ?? null;
    $this->preToolSpeech = $values['preToolSpeech'] ?? null;
    $this->assignments = $values['assignments'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'] ?? null;
    $this->toolErrorHandlingMode = $values['toolErrorHandlingMode'] ?? null;
    $this->humanDescription = $values['humanDescription'] ?? null;
    $this->enabled = $values['enabled'] ?? null;
    $this->params = $values['params'];

    $this->_dirtyFields = [
      'name' => true,
      'params' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
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
    if (array_key_exists('humanDescription', $values)) {
      $this->_dirtyFields['human_description'] = true;
    }
    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
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

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

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

    if ($this->humanDescription !== null) {
      $parts[] = [
        'name' => 'human_description',
        'contents' => $this->humanDescription
      ];
    }

    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'params',
      'contents' => json_encode($this->params),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 0, pattern: '^[a-zA-Z0-9_-]{1,64}$');
    Validator::validateString($this->description, 'description', minLength: 0);
    foreach ($this->assignments ?? [] as $item) {
      $item->validate();
    }
    Validator::validateString($this->humanDescription, 'human_description', minLength: 0);
  }
}
