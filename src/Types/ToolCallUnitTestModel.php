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
class ToolCallUnitTestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

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
   * @var ?value-of<\ElevenLabs\Types\ToolCallUnitTestModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * How to evaluate the agent's tool call (if any). If empty, the tool call is not evaluated.
   */
  #[JsonProperty('tool_call_parameters')]
  public ?\ElevenLabs\Types\UnitTestToolCallEvaluationModelOutput $toolCallParameters;

  /**
   * If set to True this test will pass if any tool call returned by the LLM matches the criteria. Otherwise it will fail if more than one tool is returned by the agent.
   */
  #[JsonProperty('check_any_tool_matches')]
  public ?bool $checkAnyToolMatches;

  /**
   * @param array{
   *   fromConversationMetadata?: ?\ElevenLabs\Types\TestFromConversationMetadataOutput,
   *   dynamicVariables?: array<string, mixed>|null,
   *   chatHistory?: \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelOutput[]|null,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   *   environment?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ToolCallUnitTestModelType>,
   *   toolCallParameters?: ?\ElevenLabs\Types\UnitTestToolCallEvaluationModelOutput,
   *   checkAnyToolMatches?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->fromConversationMetadata = $values['fromConversationMetadata'] ?? null;
    $this->dynamicVariables = $values['dynamicVariables'] ?? null;
    $this->chatHistory = $values['chatHistory'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->type = $values['type'] ?? 'tool';
    $this->toolCallParameters = $values['toolCallParameters'] ?? null;
    $this->checkAnyToolMatches = $values['checkAnyToolMatches'] ?? null;

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
