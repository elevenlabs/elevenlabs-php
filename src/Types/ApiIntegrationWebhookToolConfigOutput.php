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
class ApiIntegrationWebhookToolConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ApiIntegrationWebhookToolConfigOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

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
  #[JsonProperty('response_timeout_secs', required: true)]
  public int $responseTimeoutSecs;

  /**
   * DEPRECATED: use `interruption_mode` instead. If true, the user will not be able to interrupt the agent while this tool is running.
   */
  #[JsonProperty('disable_interruptions', required: true)]
  public bool $disableInterruptions;

  /**
   * @var value-of<\ElevenLabs\Types\ToolInterruptionMode>
   */
  #[JsonProperty('interruption_mode', required: true)]
  public string $interruptionMode;

  /**
   * DEPRECATED: use `pre_tool_speech` instead. If true, the agent will speak before the tool call.
   */
  #[JsonProperty('force_pre_tool_speech', required: true)]
  public bool $forcePreToolSpeech;

  /**
   * @var value-of<\ElevenLabs\Types\PreToolSpeechMode>
   */
  #[JsonProperty('pre_tool_speech', required: true)]
  public string $preToolSpeech;

  /**
   * @var \ElevenLabs\Types\DynamicVariableAssignment[]
   * Configuration for extracting values from tool responses and assigning them to dynamic variables
   */
  #[
    JsonProperty('assignments', required: true),
    ArrayType([\ElevenLabs\Types\DynamicVariableAssignment::class])
  ]
  public array $assignments;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundType>
   * Predefined tool call sound type to play during tool execution. If not specified, no tool call sound will be played.
   */
  #[JsonProperty('tool_call_sound', required: true)]
  public ?string $toolCallSound;

  /**
   * @var value-of<\ElevenLabs\Types\ToolCallSoundBehavior>
   * Determines how the tool call sound should be played.
   */
  #[JsonProperty('tool_call_sound_behavior', required: true)]
  public string $toolCallSoundBehavior;

  /**
   * @var value-of<\ElevenLabs\Types\ToolErrorHandlingMode>
   * Controls how tool errors are processed before being shared with the agent.
   */
  #[JsonProperty('tool_error_handling_mode', required: true)]
  public string $toolErrorHandlingMode;

  #[JsonProperty('dynamic_variables', required: true)]
  public \ElevenLabs\Types\DynamicVariablesConfig $dynamicVariables;

  /**
   * @var value-of<\ElevenLabs\Types\ToolExecutionMode>
   */
  #[JsonProperty('execution_mode', required: true)]
  public string $executionMode;

  /**
   * The version of the API integration tool
   */
  #[JsonProperty('tool_version', required: true)]
  public string $toolVersion;

  #[JsonProperty('api_integration_id', required: true)]
  public string $apiIntegrationId;

  #[JsonProperty('api_integration_connection_id', required: true)]
  public string $apiIntegrationConnectionId;

  /**
   * User overrides applied on top of the base api_schema
   */
  #[JsonProperty('api_schema_overrides', required: true)]
  public ?\ElevenLabs\Types\ApiIntegrationWebhookOverrides $apiSchemaOverrides;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ApiIntegrationWebhookToolConfigOutputType>,
   *   name: string,
   *   description: string,
   *   responseTimeoutSecs: int,
   *   disableInterruptions: bool,
   *   interruptionMode: value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   forcePreToolSpeech: bool,
   *   preToolSpeech: value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   assignments: \ElevenLabs\Types\DynamicVariableAssignment[],
   *   toolCallSound: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior: value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   toolErrorHandlingMode: value-of<\ElevenLabs\Types\ToolErrorHandlingMode>,
   *   dynamicVariables: \ElevenLabs\Types\DynamicVariablesConfig,
   *   executionMode: value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   toolVersion: string,
   *   apiIntegrationId: string,
   *   apiIntegrationConnectionId: string,
   *   apiSchemaOverrides: ?\ElevenLabs\Types\ApiIntegrationWebhookOverrides,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->name = $values['name'];
    $this->description = $values['description'];
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'];
    $this->disableInterruptions = $values['disableInterruptions'];
    $this->interruptionMode = $values['interruptionMode'];
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'];
    $this->preToolSpeech = $values['preToolSpeech'];
    $this->assignments = $values['assignments'];
    $this->toolCallSound = $values['toolCallSound'];
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'];
    $this->toolErrorHandlingMode = $values['toolErrorHandlingMode'];
    $this->dynamicVariables = $values['dynamicVariables'];
    $this->executionMode = $values['executionMode'];
    $this->toolVersion = $values['toolVersion'];
    $this->apiIntegrationId = $values['apiIntegrationId'];
    $this->apiIntegrationConnectionId = $values['apiIntegrationConnectionId'];
    $this->apiSchemaOverrides = $values['apiSchemaOverrides'];

    $this->_dirtyFields = [
      'type' => true,
      'name' => true,
      'description' => true,
      'response_timeout_secs' => true,
      'disable_interruptions' => true,
      'interruption_mode' => true,
      'force_pre_tool_speech' => true,
      'pre_tool_speech' => true,
      'assignments' => true,
      'tool_call_sound' => true,
      'tool_call_sound_behavior' => true,
      'tool_error_handling_mode' => true,
      'dynamic_variables' => true,
      'execution_mode' => true,
      'tool_version' => true,
      'api_integration_id' => true,
      'api_integration_connection_id' => true,
      'api_schema_overrides' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    $parts[] = [
      'name' => 'response_timeout_secs',
      'contents' => (string) $this->responseTimeoutSecs
    ];

    $parts[] = [
      'name' => 'disable_interruptions',
      'contents' => $this->disableInterruptions ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'interruption_mode',
      'contents' => $this->interruptionMode
    ];

    $parts[] = [
      'name' => 'force_pre_tool_speech',
      'contents' => $this->forcePreToolSpeech ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'pre_tool_speech',
      'contents' => $this->preToolSpeech
    ];

    $parts[] = [
      'name' => 'assignments',
      'contents' => json_encode($this->assignments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'tool_call_sound',
      'contents' => $this->toolCallSound
    ];

    $parts[] = [
      'name' => 'tool_call_sound_behavior',
      'contents' => $this->toolCallSoundBehavior
    ];

    $parts[] = [
      'name' => 'tool_error_handling_mode',
      'contents' => $this->toolErrorHandlingMode
    ];

    $parts[] = [
      'name' => 'dynamic_variables',
      'contents' => json_encode($this->dynamicVariables),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'execution_mode',
      'contents' => $this->executionMode
    ];

    $parts[] = [
      'name' => 'tool_version',
      'contents' => $this->toolVersion
    ];

    $parts[] = [
      'name' => 'api_integration_id',
      'contents' => $this->apiIntegrationId
    ];

    $parts[] = [
      'name' => 'api_integration_connection_id',
      'contents' => $this->apiIntegrationConnectionId
    ];

    $parts[] = [
      'name' => 'api_schema_overrides',
      'contents' => json_encode($this->apiSchemaOverrides),
      'headers' => ['Content-Type' => 'application/json']
    ];

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
    foreach ($this->assignments as $item) {
      $item->validate();
    }
    $this->dynamicVariables->validate();
    $this->apiSchemaOverrides?->validate();
  }
}
