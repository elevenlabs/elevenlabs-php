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
class GetResponseUnitTestResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The access information for the requesting user on this test.
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * Metadata of a conversation this test was created from (if applicable).
   */
  #[JsonProperty('from_conversation_metadata')]
  public ?\ElevenLabs\Types\TestFromConversationMetadataOutput $fromConversationMetadata;

  /**
   * @var array<string, mixed>|null
   * Dynamic variables to replace in the agent config during testing
   */
  #[JsonProperty('dynamic_variables'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariables;

  /**
   * @var \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null
   */
  #[
    JsonProperty('chat_history'),
    ArrayType([\ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput::class])
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
   * @var ?value-of<\ElevenLabs\Types\GetResponseUnitTestResponseModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * A prompt that evaluates whether the agent's response is successful. Should return True or False.
   */
  #[JsonProperty('success_condition')]
  public ?string $successCondition;

  /**
   * @var \ElevenLabs\Types\AgentSuccessfulResponseExample[]|null
   * Non-empty list of example responses that should be considered successful
   */
  #[
    JsonProperty('success_examples'),
    ArrayType([\ElevenLabs\Types\AgentSuccessfulResponseExample::class])
  ]
  public ?array $successExamples;

  /**
   * @var \ElevenLabs\Types\AgentFailureResponseExample[]|null
   * Non-empty list of example responses that should be considered failures
   */
  #[
    JsonProperty('failure_examples'),
    ArrayType([\ElevenLabs\Types\AgentFailureResponseExample::class])
  ]
  public ?array $failureExamples;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   fromConversationMetadata?: ?\ElevenLabs\Types\TestFromConversationMetadataOutput,
   *   dynamicVariables?: array<string, mixed>|null,
   *   chatHistory?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   environment?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\GetResponseUnitTestResponseModelType>,
   *   successCondition?: ?string,
   *   successExamples?: \ElevenLabs\Types\AgentSuccessfulResponseExample[]|null,
   *   failureExamples?: \ElevenLabs\Types\AgentFailureResponseExample[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->fromConversationMetadata = $values['fromConversationMetadata'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->chatHistory = $values['chatHistory'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->type = $values['type'] ?? 'llm';
    $this->successCondition = $values['successCondition'] ?? null;
    $this->successExamples = $values['successExamples'] ?? null;
    $this->failureExamples = $values['failureExamples'] ?? null;
    $this->id = $values['id'];
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
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
    if (array_key_exists('successCondition', $values)) {
      $this->_dirtyFields['success_condition'] = true;
    }
    if (array_key_exists('successExamples', $values)) {
      $this->_dirtyFields['success_examples'] = true;
    }
    if (array_key_exists('failureExamples', $values)) {
      $this->_dirtyFields['failure_examples'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    if ($this->successCondition !== null) {
      $parts[] = [
        'name' => 'success_condition',
        'contents' => $this->successCondition
      ];
    }

    if ($this->successExamples !== null) {
      $parts[] = [
        'name' => 'success_examples',
        'contents' => json_encode($this->successExamples),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->failureExamples !== null) {
      $parts[] = [
        'name' => 'failure_examples',
        'contents' => json_encode($this->failureExamples),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo?->validate();
    $this->fromConversationMetadata?->validate();
    foreach ($this->chatHistory ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->chatHistory, 'chat_history', maxItems: 200);
    foreach ($this->successExamples ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->successExamples, 'success_examples', maxItems: 5);
    foreach ($this->failureExamples ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->failureExamples, 'failure_examples', maxItems: 5);
  }
}
