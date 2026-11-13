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
class CreateToolCallUnitTestRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Metadata of a conversation this test was created from (if applicable).
   */
  #[JsonProperty('from_conversation_metadata')]
  public ?\ElevenLabs\Types\TestFromConversationMetadataInput $fromConversationMetadata;

  /**
   * @var array<string, mixed>|null
   * Dynamic variables to replace in the agent config during testing
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput[]|null
   */
  #[
    JsonProperty('chat_history'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput::class])
  ]
  public ?array $chatHistory;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   * Simulate the test as if the conversation originated from this channel.
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  /**
   * The environment to resolve environment-specific variable values against when running this test (URL, headers, auth connections). If not provided, defaults to 'production'. For simulation tests, simulation_environment takes precedence when set.
   */
  #[JsonProperty('environment')]
  public ?string $environment;

  /**
   * @var ?value-of<\ElevenLabs\Types\CreateToolCallUnitTestRequestType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * How to evaluate the agent's tool call (if any). If empty, the tool call is not evaluated.
   */
  #[JsonProperty('tool_call_parameters')]
  public ?\ElevenLabs\Types\UnitTestToolCallEvaluationModelInput $toolCallParameters;

  /**
   * If set to True this test will pass if any tool call returned by the LLM matches the criteria. Otherwise it will fail if more than one tool is returned by the agent.
   */
  #[JsonProperty('check_any_tool_matches')]
  public ?bool $checkAnyToolMatches;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The ID of the parent folder. If not provided, the test will be created at the root level.
   */
  #[JsonProperty('parent_folder_id')]
  public ?string $parentFolderId;

  /**
   * @param array{
   *   name: string,
   *   fromConversationMetadata?: ?\ElevenLabs\Types\TestFromConversationMetadataInput,
   *   dynamicVariables?: array<string, mixed>|null,
   *   chatHistory?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput[]|null,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   environment?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\CreateToolCallUnitTestRequestType>,
   *   toolCallParameters?: ?\ElevenLabs\Types\UnitTestToolCallEvaluationModelInput,
   *   checkAnyToolMatches?: ?bool,
   *   parentFolderId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->fromConversationMetadata = $values['fromConversationMetadata'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->chatHistory = $values['chatHistory'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->type = $values['type'] ?? 'tool';
    $this->toolCallParameters = $values['toolCallParameters'] ?? null;
    $this->checkAnyToolMatches = $values['checkAnyToolMatches'] ?? null;
    $this->name = $values['name'];
    $this->parentFolderId = $values['parentFolderId'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('fromConversationMetadata', $values)) {
      $this->_dirtyFields['from_conversation_metadata'] = true;
    }
    if (array_key_exists('dynamicVariables', $values)) {
      $this->_dirtyFields['dynamic_variables'] = true;
    }
    if (array_key_exists('chatHistory', $values)) {
      $this->_dirtyFields['chat_history'] = true;
    }
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
    }
    if (array_key_exists('environment', $values)) {
      $this->_dirtyFields['environment'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('toolCallParameters', $values)) {
      $this->_dirtyFields['tool_call_parameters'] = true;
    }
    if (array_key_exists('checkAnyToolMatches', $values)) {
      $this->_dirtyFields['check_any_tool_matches'] = true;
    }
    if (array_key_exists('parentFolderId', $values)) {
      $this->_dirtyFields['parent_folder_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->fromConversationMetadata !== null) {
      $parts[] = [
        'name' => 'from_conversation_metadata',
        'contents' => json_encode($this->fromConversationMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dynamicVariables !== null) {
      $parts[] = [
        'name' => 'dynamic_variables',
        'contents' => json_encode($this->dynamicVariables),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->chatHistory !== null) {
      $parts[] = [
        'name' => 'chat_history',
        'contents' => json_encode($this->chatHistory),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    if ($this->environment !== null) {
      $parts[] = [
        'name' => 'environment',
        'contents' => $this->environment
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->toolCallParameters !== null) {
      $parts[] = [
        'name' => 'tool_call_parameters',
        'contents' => json_encode($this->toolCallParameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->checkAnyToolMatches !== null) {
      $parts[] = [
        'name' => 'check_any_tool_matches',
        'contents' => $this->checkAnyToolMatches ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->parentFolderId !== null) {
      $parts[] = [
        'name' => 'parent_folder_id',
        'contents' => $this->parentFolderId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->fromConversationMetadata?->validate();
    foreach ($this->chatHistory ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->chatHistory, 'chat_history', maxItems: 200);
    $this->toolCallParameters?->validate();
  }
}
