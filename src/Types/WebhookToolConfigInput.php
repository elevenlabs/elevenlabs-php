<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * A webhook tool is a tool that calls an external webhook from our server
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WebhookToolConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WebhookToolConfigInputType>
   * The type of tool
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

  #[JsonProperty('api_schema', required: true)]
  public \ElevenLabs\Types\WebhookToolApiSchemaConfigInput $apiSchema;

  /**
   * Whether to resolve a redirect from the endpoint and return the final response. One redirect is followed, as a GET without the request body; nothing configured on this tool (headers, authentication, client certificate) is sent to the redirect target. Both the endpoint and the redirect target must use HTTPS. Not supported for API integration tools.
   */
  #[JsonProperty('follow_redirects')]
  public ?bool $followRedirects;

  /**
   * @var string[]|null
   * Domains a redirect may point at, e.g. 'test.example.com'. Required when following redirects, and a target outside the list is refused.
   */
  #[JsonProperty('follow_redirects_allowed_domains'), ArrayType(['string'])]
  public ?array $followRedirectsAllowedDomains;

  /**
   * @param array{
   *   name: string,
   *   description: string,
   *   apiSchema: \ElevenLabs\Types\WebhookToolApiSchemaConfigInput,
   *   type?: ?value-of<\ElevenLabs\Types\WebhookToolConfigInputType>,
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
   *   followRedirects?: ?bool,
   *   followRedirectsAllowedDomains?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'webhook';
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
    $this->apiSchema = $values['apiSchema'];
    $this->followRedirects = $values['followRedirects'] ?? null;
    $this->followRedirectsAllowedDomains = $values['followRedirectsAllowedDomains'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'description' => true,
      'api_schema' => true
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
    if (array_key_exists('followRedirects', $values)) {
      $this->_dirtyFields['follow_redirects'] = true;
    }
    if (array_key_exists('followRedirectsAllowedDomains', $values)) {
      $this->_dirtyFields['follow_redirects_allowed_domains'] = true;
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

    $parts[] = [
      'name' => 'api_schema',
      'contents' => json_encode($this->apiSchema),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->followRedirects !== null) {
      $parts[] = [
        'name' => 'follow_redirects',
        'contents' => $this->followRedirects ? 'true' : 'false'
      ];
    }

    if ($this->followRedirectsAllowedDomains !== null) {
      foreach ($this->followRedirectsAllowedDomains ?? [] as $item) {
        $parts[] = [
          'name' => 'follow_redirects_allowed_domains',
          'contents' => $item
        ];
      }
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
    $this->apiSchema->validate();
    Validator::validateArray(
      $this->followRedirectsAllowedDomains,
      'follow_redirects_allowed_domains',
      maxItems: 20
    );
  }
}
