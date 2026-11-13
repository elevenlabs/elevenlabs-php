<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * An MCP tool configuration that can be used to call MCP servers
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpToolConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpToolConfigInputType>
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
   * The maximum time in seconds to wait for the MCP tool call to complete. Must be between 5 and 300 seconds (inclusive).
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
   * @var value-of<\ElevenLabs\Types\IntegrationType>
   */
  #[JsonProperty('integration_type', required: true)]
  public string $integrationType;

  /**
   * Schema for any parameters the LLM needs to provide to the MCP tool.
   */
  #[JsonProperty('parameters')]
  public ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput $parameters;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpApprovalPolicy>
   * Defines the MCP server-level approval policy for tool execution.
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

  /**
   * The name of the MCP tool to call
   */
  #[JsonProperty('mcp_tool_name', required: true)]
  public string $mcpToolName;

  /**
   * The description of the MCP tool to call
   */
  #[JsonProperty('mcp_tool_description', required: true)]
  public string $mcpToolDescription;

  /**
   * The id of the MCP server to call
   */
  #[JsonProperty('mcp_server_id', required: true)]
  public string $mcpServerId;

  /**
   * The name of the MCP server to call
   */
  #[JsonProperty('mcp_server_name', required: true)]
  public string $mcpServerName;

  /**
   * @var array<string, mixed>|null
   * Original inputSchema dict for consistent hashing
   */
  #[JsonProperty('mcp_input_schema'), ArrayType(['string' => 'mixed'])]
  public ?array $mcpInputSchema;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolExecutionMode>
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * @var array<string, \ElevenLabs\Types\McpToolConfigInputInputOverridesValue>|null
   * Input parameter overrides for this tool
   */
  #[
    JsonProperty('input_overrides'),
    ArrayType(['string' => \ElevenLabs\Types\McpToolConfigInputInputOverridesValue::class])
  ]
  public ?array $inputOverrides;

  /**
   * @param array{
   *   name: string,
   *   description: string,
   *   integrationType: value-of<\ElevenLabs\Types\IntegrationType>,
   *   mcpToolName: string,
   *   mcpToolDescription: string,
   *   mcpServerId: string,
   *   mcpServerName: string,
   *   type?: ?value-of<\ElevenLabs\Types\McpToolConfigInputType>,
   *   responseTimeoutSecs?: ?int,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   assignments?: \ElevenLabs\Types\DynamicVariableAssignment[]|null,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   toolErrorHandlingMode?: ?value-of<\ElevenLabs\Types\ToolErrorHandlingMode>,
   *   parameters?: ?\ElevenLabs\Types\ObjectJsonSchemaPropertyInput,
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpApprovalPolicy>,
   *   mcpInputSchema?: array<string, mixed>|null,
   *   executionMode?: ?value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   inputOverrides?: array<string, \ElevenLabs\Types\McpToolConfigInputInputOverridesValue>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'mcp';
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
    $this->integrationType = $values['integrationType'];
    $this->parameters = $values['parameters'] ?? null;
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;
    $this->mcpToolName = $values['mcpToolName'];
    $this->mcpToolDescription = $values['mcpToolDescription'];
    $this->mcpServerId = $values['mcpServerId'];
    $this->mcpServerName = $values['mcpServerName'];
    $this->mcpInputSchema = $values['mcpInputSchema'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->inputOverrides = $values['inputOverrides'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'description' => true,
      'integration_type' => true,
      'mcp_tool_name' => true,
      'mcp_tool_description' => true,
      'mcp_server_id' => true,
      'mcp_server_name' => true
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
    if (array_key_exists('parameters', $values)) {
      $this->_dirtyFields['parameters'] = true;
    }
    if (array_key_exists('approvalPolicy', $values)) {
      $this->_dirtyFields['approval_policy'] = true;
    }
    if (array_key_exists('mcpInputSchema', $values)) {
      $this->_dirtyFields['mcp_input_schema'] = true;
    }
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('inputOverrides', $values)) {
      $this->_dirtyFields['input_overrides'] = true;
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

    $parts[] = [
      'name' => 'integration_type',
      'contents' => $this->integrationType
    ];

    if ($this->parameters !== null) {
      $parts[] = [
        'name' => 'parameters',
        'contents' => json_encode($this->parameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->approvalPolicy !== null) {
      $parts[] = [
        'name' => 'approval_policy',
        'contents' => $this->approvalPolicy
      ];
    }

    $parts[] = [
      'name' => 'mcp_tool_name',
      'contents' => $this->mcpToolName
    ];

    $parts[] = [
      'name' => 'mcp_tool_description',
      'contents' => $this->mcpToolDescription
    ];

    $parts[] = [
      'name' => 'mcp_server_id',
      'contents' => $this->mcpServerId
    ];

    $parts[] = [
      'name' => 'mcp_server_name',
      'contents' => $this->mcpServerName
    ];

    if ($this->mcpInputSchema !== null) {
      $parts[] = [
        'name' => 'mcp_input_schema',
        'contents' => json_encode($this->mcpInputSchema),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->inputOverrides !== null) {
      $parts[] = [
        'name' => 'input_overrides',
        'contents' => json_encode($this->inputOverrides),
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
    $this->parameters?->validate();
  }
}
