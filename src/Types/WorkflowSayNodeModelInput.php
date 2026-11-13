<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowSayNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowSayNodeModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('position')]
  public ?\ElevenLabs\Types\PositionInput $position;

  /**
   * @var string[]|null
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order'), ArrayType(['string'])]
  public ?array $edgeOrder;

  #[JsonProperty('conversation_config')]
  public ?\ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideInput $conversationConfig;

  /**
   * Accepted for consistency with subagent nodes but not used. Describe the message in `message.prompt`, or replace the system prompt with `conversation_config.agent.prompt.prompt`.
   */
  #[JsonProperty('additional_prompt')]
  public ?string $additionalPrompt;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]|null
   * Knowledge base documents available to the LLM while this node generates its message, in addition to the agent's documents.
   */
  #[
    JsonProperty('additional_knowledge_base'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])
  ]
  public ?array $additionalKnowledgeBase;

  /**
   * @var string[]|null
   * Accepted for consistency with subagent nodes but not used. A say node cannot call tools.
   */
  #[JsonProperty('additional_tool_ids'), ArrayType(['string'])]
  public ?array $additionalToolIds;

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * Message spoken by this node. Use `literal` for exact text or `prompt` to have the LLM generate the message from a description.
   */
  #[JsonProperty('message', required: true)]
  public \ElevenLabs\Types\WorkflowSayNodeModelInputMessage $message;

  /**
   * When true, the workflow only moves to the next node after the message has been fully spoken.
   */
  #[JsonProperty('wait_for_speech_completion')]
  public ?bool $waitForSpeechCompletion;

  /**
   * When true, the node speaks its message and then waits for the user to reply before evaluating outgoing edges, so edges can branch on the reply. If the user stays silent, the workflow advances after the turn timeout.
   */
  #[JsonProperty('wait_for_user_response')]
  public ?bool $waitForUserResponse;

  /**
   * @param array{
   *   label: string,
   *   message: \ElevenLabs\Types\WorkflowSayNodeModelInputMessage,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowSayNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   *   conversationConfig?: ?\ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideInput,
   *   additionalPrompt?: ?string,
   *   additionalKnowledgeBase?: \ElevenLabs\Types\KnowledgeBaseLocator[]|null,
   *   additionalToolIds?: string[]|null,
   *   waitForSpeechCompletion?: ?bool,
   *   waitForUserResponse?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'say';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->conversationConfig = $values['conversationConfig'] ?? null;
    $this->additionalPrompt = $values['additionalPrompt'] ?? null;
    $this->additionalKnowledgeBase = $values['additionalKnowledgeBase'] ?? null;
    $this->additionalToolIds = $values['additionalToolIds'] ?? null;
    $this->label = $values['label'];
    $this->message = $values['message'];
    $this->waitForSpeechCompletion = $values['waitForSpeechCompletion'] ?? null;
    $this->waitForUserResponse = $values['waitForUserResponse'] ?? null;

    $this->_dirtyFields = [
      'label' => true,
      'message' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('position', $values)) {
      $this->_dirtyFields['position'] = true;
    }
    if (array_key_exists('edgeOrder', $values)) {
      $this->_dirtyFields['edge_order'] = true;
    }
    if (array_key_exists('conversationConfig', $values)) {
      $this->_dirtyFields['conversation_config'] = true;
    }
    if (array_key_exists('additionalPrompt', $values)) {
      $this->_dirtyFields['additional_prompt'] = true;
    }
    if (array_key_exists('additionalKnowledgeBase', $values)) {
      $this->_dirtyFields['additional_knowledge_base'] = true;
    }
    if (array_key_exists('additionalToolIds', $values)) {
      $this->_dirtyFields['additional_tool_ids'] = true;
    }
    if (array_key_exists('waitForSpeechCompletion', $values)) {
      $this->_dirtyFields['wait_for_speech_completion'] = true;
    }
    if (array_key_exists('waitForUserResponse', $values)) {
      $this->_dirtyFields['wait_for_user_response'] = true;
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

    if ($this->position !== null) {
      $parts[] = [
        'name' => 'position',
        'contents' => json_encode($this->position),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->edgeOrder !== null) {
      foreach ($this->edgeOrder ?? [] as $item) {
        $parts[] = [
          'name' => 'edge_order',
          'contents' => $item
        ];
      }
    }

    if ($this->conversationConfig !== null) {
      $parts[] = [
        'name' => 'conversation_config',
        'contents' => json_encode($this->conversationConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->additionalPrompt !== null) {
      $parts[] = [
        'name' => 'additional_prompt',
        'contents' => $this->additionalPrompt
      ];
    }

    if ($this->additionalKnowledgeBase !== null) {
      $parts[] = [
        'name' => 'additional_knowledge_base',
        'contents' => json_encode($this->additionalKnowledgeBase),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->additionalToolIds !== null) {
      foreach ($this->additionalToolIds ?? [] as $item) {
        $parts[] = [
          'name' => 'additional_tool_ids',
          'contents' => $item
        ];
      }
    }

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => json_encode($this->message),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->waitForSpeechCompletion !== null) {
      $parts[] = [
        'name' => 'wait_for_speech_completion',
        'contents' => $this->waitForSpeechCompletion ? 'true' : 'false'
      ];
    }

    if ($this->waitForUserResponse !== null) {
      $parts[] = [
        'name' => 'wait_for_user_response',
        'contents' => $this->waitForUserResponse ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->position?->validate();
    $this->conversationConfig?->validate();
    foreach ($this->additionalKnowledgeBase ?? [] as $item) {
      $item->validate();
    }
  }
}
