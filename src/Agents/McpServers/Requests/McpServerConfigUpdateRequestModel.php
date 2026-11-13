<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\McpServers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * Unified request model for updating MCP Server configuration.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class McpServerConfigUpdateRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpApprovalPolicy>
   * The approval mode to set for the MCP server
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

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
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundType>
   * Predefined tool call sound type to play during tool execution for all tools from this MCP server
   */
  #[JsonProperty('tool_call_sound')]
  public ?string $toolCallSound;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>
   * Determines when the tool call sound should play for all tools from this MCP server
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
   * The maximum time in seconds to wait for each MCP tool call to complete.
   */
  #[JsonProperty('response_timeout_secs')]
  public ?int $responseTimeoutSecs;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null
   * The headers to include in requests to the MCP server
   */
  #[
    JsonProperty('request_headers'),
    ArrayType([
      'string' => new Union(
        'string',
        \ElevenLabs\Types\ConvAiSecretLocator::class,
        \ElevenLabs\Types\ConvAiDynamicVariable::class,
        \ElevenLabs\Types\ConvAiEnvVarLocator::class
      )
    ])
  ]
  public ?array $requestHeaders;

  /**
   * @var array<string, string|int|float|bool|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null
   * Entries sent in the MCP `_meta` field of tools/call requests. Values may be JSON scalars, or references to a workspace secret, dynamic variable, or environment variable resolved per call.
   */
  #[
    JsonProperty('request_meta'),
    ArrayType([
      'string' => new Union(
        'string',
        'integer',
        'float',
        'bool',
        \ElevenLabs\Types\ConvAiSecretLocator::class,
        \ElevenLabs\Types\ConvAiDynamicVariable::class,
        \ElevenLabs\Types\ConvAiEnvVarLocator::class
      )
    ])
  ]
  public ?array $requestMeta;

  /**
   * Whether to disable HTTP compression for this MCP server
   */
  #[JsonProperty('disable_compression')]
  public ?bool $disableCompression;

  /**
   * Optional secret token for authentication with this MCP server
   */
  #[JsonProperty('secret_token')]
  public ?\ElevenLabs\Types\ConvAiSecretLocator $secretToken;

  /**
   * Optional auth connection to use for authentication with this MCP server
   */
  #[
    JsonProperty('auth_connection'),
    Union(
      \ElevenLabs\Types\AuthConnectionLocator::class,
      \ElevenLabs\Types\EnvironmentAuthConnectionLocator::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null $authConnection;

  /**
   * @param array{
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpApprovalPolicy>,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   executionMode?: ?value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   responseTimeoutSecs?: ?int,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   requestMeta?: array<string, string|int|float|bool|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   disableCompression?: ?bool,
   *   secretToken?: ?\ElevenLabs\Types\ConvAiSecretLocator,
   *   authConnection?: \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'] ?? null;
    $this->preToolSpeech = $values['preToolSpeech'] ?? null;
    $this->disableInterruptions = $values['disableInterruptions'] ?? null;
    $this->interruptionMode = $values['interruptionMode'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'] ?? null;
    $this->requestHeaders = $values['requestHeaders'] ?? null;
    $this->requestMeta = $values['requestMeta'] ?? null;
    $this->disableCompression = $values['disableCompression'] ?? null;
    $this->secretToken = $values['secretToken'] ?? null;
    $this->authConnection = $values['authConnection'] ?? null;

    if (array_key_exists('approvalPolicy', $values)) {
      $this->_dirtyFields['approval_policy'] = true;
    }
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
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
    if (array_key_exists('requestMeta', $values)) {
      $this->_dirtyFields['request_meta'] = true;
    }
    if (array_key_exists('disableCompression', $values)) {
      $this->_dirtyFields['disable_compression'] = true;
    }
    if (array_key_exists('secretToken', $values)) {
      $this->_dirtyFields['secret_token'] = true;
    }
    if (array_key_exists('authConnection', $values)) {
      $this->_dirtyFields['auth_connection'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->approvalPolicy !== null) {
      $parts[] = [
        'name' => 'approval_policy',
        'contents' => $this->approvalPolicy
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
        'contents' => $this->toolCallSound
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

    if ($this->requestHeaders !== null) {
      $parts[] = [
        'name' => 'request_headers',
        'contents' => json_encode($this->requestHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requestMeta !== null) {
      $parts[] = [
        'name' => 'request_meta',
        'contents' => json_encode($this->requestMeta),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->disableCompression !== null) {
      $parts[] = [
        'name' => 'disable_compression',
        'contents' => $this->disableCompression ? 'true' : 'false'
      ];
    }

    if ($this->secretToken !== null) {
      $parts[] = [
        'name' => 'secret_token',
        'contents' => json_encode($this->secretToken),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->authConnection !== null) {
      $parts[] = [
        'name' => 'auth_connection',
        'contents' => json_encode($this->authConnection),
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
    $this->secretToken?->validate();
  }
}
