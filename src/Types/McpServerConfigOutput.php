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
class McpServerConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpApprovalPolicy>
   * Defines the MCP server-level approval policy for tool execution.
   */
  #[JsonProperty('approval_policy')]
  public ?string $approvalPolicy;

  /**
   * @var \ElevenLabs\Types\McpToolApprovalHash[]|null
   * List of tool approval hashes for per-tool approval when approval_policy is REQUIRE_APPROVAL_PER_TOOL
   */
  #[JsonProperty('tool_approval_hashes'), ArrayType([\ElevenLabs\Types\McpToolApprovalHash::class])]
  public ?array $toolApprovalHashes;

  /**
   * @var ?value-of<\ElevenLabs\Types\McpServerTransport>
   * Supported MCP server transport types.
   */
  #[JsonProperty('transport')]
  public ?string $transport;

  /**
   * The URL of the MCP server, if this contains a secret please store as a workspace secret, otherwise store as a plain string. Must use https
   */
  #[
    JsonProperty('url', required: true),
    Union('string', \ElevenLabs\Types\ConvAiSecretLocator::class)
  ]
  public string|\ElevenLabs\Types\ConvAiSecretLocator $url;

  /**
   * The secret token (Authorization header) stored as a workspace secret or in-place secret
   */
  #[
    JsonProperty('secret_token'),
    Union(
      \ElevenLabs\Types\ConvAiSecretLocator::class,
      \ElevenLabs\Types\ConvAiUserSecretDbModel::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiUserSecretDbModel|null $secretToken;

  /**
   * @var array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null
   * The headers included in the request
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

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * DEPRECATED: use `pre_tool_speech` instead. If true, all tools from this MCP server will require pre-tool execution speech.
   */
  #[JsonProperty('force_pre_tool_speech')]
  public ?bool $forcePreToolSpeech;

  /**
   * @var ?value-of<\ElevenLabs\Types\PreToolSpeechMode>
   */
  #[JsonProperty('pre_tool_speech')]
  public ?string $preToolSpeech;

  /**
   * DEPRECATED: use `interruption_mode` instead. If true, the user will not be able to interrupt the agent while any tool from this MCP server is running.
   */
  #[JsonProperty('disable_interruptions')]
  public ?bool $disableInterruptions;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolInterruptionMode>
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
   * Determines how the tool call sound should be played.
   */
  #[JsonProperty('tool_call_sound_behavior')]
  public ?string $toolCallSoundBehavior;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolExecutionMode>
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * The maximum time in seconds to wait for each MCP tool call to complete. Must be between 5 and 300 seconds (inclusive).
   */
  #[JsonProperty('response_timeout_secs')]
  public ?int $responseTimeoutSecs;

  /**
   * @var \ElevenLabs\Types\McpToolConfigOverrideOutput[]|null
   * List of per-tool configuration overrides that override the server-level defaults for specific tools
   */
  #[
    JsonProperty('tool_config_overrides'),
    ArrayType([\ElevenLabs\Types\McpToolConfigOverrideOutput::class])
  ]
  public ?array $toolConfigOverrides;

  /**
   * Whether to disable HTTP compression for this MCP server. Enable this if the server does not support compressed responses.
   */
  #[JsonProperty('disable_compression')]
  public ?bool $disableCompression;

  /**
   * @param array{
   *   url: string|\ElevenLabs\Types\ConvAiSecretLocator,
   *   name: string,
   *   approvalPolicy?: ?value-of<\ElevenLabs\Types\McpApprovalPolicy>,
   *   toolApprovalHashes?: \ElevenLabs\Types\McpToolApprovalHash[]|null,
   *   transport?: ?value-of<\ElevenLabs\Types\McpServerTransport>,
   *   secretToken?: \ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiUserSecretDbModel|null,
   *   requestHeaders?: array<string, string|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   requestMeta?: array<string, string|int|float|bool|\ElevenLabs\Types\ConvAiSecretLocator|\ElevenLabs\Types\ConvAiDynamicVariable|\ElevenLabs\Types\ConvAiEnvVarLocator>|null,
   *   authConnection?: \ElevenLabs\Types\AuthConnectionLocator|\ElevenLabs\Types\EnvironmentAuthConnectionLocator|null,
   *   description?: ?string,
   *   forcePreToolSpeech?: ?bool,
   *   preToolSpeech?: ?value-of<\ElevenLabs\Types\PreToolSpeechMode>,
   *   disableInterruptions?: ?bool,
   *   interruptionMode?: ?value-of<\ElevenLabs\Types\ToolInterruptionMode>,
   *   toolCallSound?: ?value-of<\ElevenLabs\Types\ToolCallSoundType>,
   *   toolCallSoundBehavior?: ?value-of<\ElevenLabs\Types\ToolCallSoundBehavior>,
   *   executionMode?: ?value-of<\ElevenLabs\Types\ToolExecutionMode>,
   *   responseTimeoutSecs?: ?int,
   *   toolConfigOverrides?: \ElevenLabs\Types\McpToolConfigOverrideOutput[]|null,
   *   disableCompression?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->approvalPolicy = $values['approvalPolicy'] ?? null;
    $this->toolApprovalHashes = $values['toolApprovalHashes'] ?? null;
    $this->transport = $values['transport'] ?? null;
    $this->url = $values['url'];
    $this->secretToken = $values['secretToken'] ?? null;
    $this->requestHeaders = $values['requestHeaders'] ?? null;
    $this->requestMeta = $values['requestMeta'] ?? null;
    $this->authConnection = $values['authConnection'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->forcePreToolSpeech = $values['forcePreToolSpeech'] ?? null;
    $this->preToolSpeech = $values['preToolSpeech'] ?? null;
    $this->disableInterruptions = $values['disableInterruptions'] ?? null;
    $this->interruptionMode = $values['interruptionMode'] ?? null;
    $this->toolCallSound = $values['toolCallSound'] ?? null;
    $this->toolCallSoundBehavior = $values['toolCallSoundBehavior'] ?? null;
    $this->executionMode = $values['executionMode'] ?? null;
    $this->responseTimeoutSecs = $values['responseTimeoutSecs'] ?? null;
    $this->toolConfigOverrides = $values['toolConfigOverrides'] ?? null;
    $this->disableCompression = $values['disableCompression'] ?? null;

    $this->_dirtyFields = [
      'url' => true,
      'name' => true
    ];
    if (array_key_exists('approvalPolicy', $values)) {
      $this->_dirtyFields['approval_policy'] = true;
    }
    if (array_key_exists('toolApprovalHashes', $values)) {
      $this->_dirtyFields['tool_approval_hashes'] = true;
    }
    if (array_key_exists('transport', $values)) {
      $this->_dirtyFields['transport'] = true;
    }
    if (array_key_exists('secretToken', $values)) {
      $this->_dirtyFields['secret_token'] = true;
    }
    if (array_key_exists('requestHeaders', $values)) {
      $this->_dirtyFields['request_headers'] = true;
    }
    if (array_key_exists('requestMeta', $values)) {
      $this->_dirtyFields['request_meta'] = true;
    }
    if (array_key_exists('authConnection', $values)) {
      $this->_dirtyFields['auth_connection'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
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
    if (array_key_exists('toolConfigOverrides', $values)) {
      $this->_dirtyFields['tool_config_overrides'] = true;
    }
    if (array_key_exists('disableCompression', $values)) {
      $this->_dirtyFields['disable_compression'] = true;
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

    if ($this->toolApprovalHashes !== null) {
      $parts[] = [
        'name' => 'tool_approval_hashes',
        'contents' => json_encode($this->toolApprovalHashes),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transport !== null) {
      $parts[] = [
        'name' => 'transport',
        'contents' => $this->transport
      ];
    }

    $parts[] = [
      'name' => 'url',
      'contents' => json_encode($this->url),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->secretToken !== null) {
      $parts[] = [
        'name' => 'secret_token',
        'contents' => json_encode($this->secretToken),
        'headers' => ['Content-Type' => 'application/json']
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

    if ($this->authConnection !== null) {
      $parts[] = [
        'name' => 'auth_connection',
        'contents' => json_encode($this->authConnection),
        'headers' => ['Content-Type' => 'application/json']
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

    if ($this->toolConfigOverrides !== null) {
      $parts[] = [
        'name' => 'tool_config_overrides',
        'contents' => json_encode($this->toolConfigOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->disableCompression !== null) {
      $parts[] = [
        'name' => 'disable_compression',
        'contents' => $this->disableCompression ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->toolApprovalHashes ?? [] as $item) {
      $item->validate();
    }
    Validator::validateNumber(
      $this->responseTimeoutSecs,
      'response_timeout_secs',
      min: 5,
      max: 300
    );
    foreach ($this->toolConfigOverrides ?? [] as $item) {
      $item->validate();
    }
  }
}
