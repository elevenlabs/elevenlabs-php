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
class WorkflowSayNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowSayNodeModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('position', required: true)]
  public \ElevenLabs\Types\PositionOutput $position;

  /**
   * @var string[]
   * The ids of outgoing edges in the order they should be evaluated.
   */
  #[JsonProperty('edge_order', required: true), ArrayType(['string'])]
  public array $edgeOrder;

  #[JsonProperty('conversation_config', required: true)]
  public \ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideOutput $conversationConfig;

  /**
   * Accepted for consistency with subagent nodes but not used. Describe the message in `message.prompt`, or replace the system prompt with `conversation_config.agent.prompt.prompt`.
   */
  #[JsonProperty('additional_prompt', required: true)]
  public string $additionalPrompt;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]
   * Knowledge base documents available to the LLM while this node generates its message, in addition to the agent's documents.
   */
  #[
    JsonProperty('additional_knowledge_base', required: true),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])
  ]
  public array $additionalKnowledgeBase;

  /**
   * @var string[]
   * Accepted for consistency with subagent nodes but not used. A say node cannot call tools.
   */
  #[JsonProperty('additional_tool_ids', required: true), ArrayType(['string'])]
  public array $additionalToolIds;

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * Message spoken by this node. Use `literal` for exact text or `prompt` to have the LLM generate the message from a description.
   */
  #[JsonProperty('message', required: true)]
  public \ElevenLabs\Types\WorkflowSayNodeModelOutputMessage $message;

  /**
   * When true, the workflow only moves to the next node after the message has been fully spoken.
   */
  #[JsonProperty('wait_for_speech_completion', required: true)]
  public bool $waitForSpeechCompletion;

  /**
   * When true, the node speaks its message and then waits for the user to reply before evaluating outgoing edges, so edges can branch on the reply. If the user stays silent, the workflow advances after the turn timeout.
   */
  #[JsonProperty('wait_for_user_response', required: true)]
  public bool $waitForUserResponse;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowSayNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   *   conversationConfig: \ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideOutput,
   *   additionalPrompt: string,
   *   additionalKnowledgeBase: \ElevenLabs\Types\KnowledgeBaseLocator[],
   *   additionalToolIds: string[],
   *   label: string,
   *   message: \ElevenLabs\Types\WorkflowSayNodeModelOutputMessage,
   *   waitForSpeechCompletion: bool,
   *   waitForUserResponse: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->position = $values['position'];
    $this->edgeOrder = $values['edgeOrder'];
    $this->conversationConfig = $values['conversationConfig'];
    $this->additionalPrompt = $values['additionalPrompt'];
    $this->additionalKnowledgeBase = $values['additionalKnowledgeBase'];
    $this->additionalToolIds = $values['additionalToolIds'];
    $this->label = $values['label'];
    $this->message = $values['message'];
    $this->waitForSpeechCompletion = $values['waitForSpeechCompletion'];
    $this->waitForUserResponse = $values['waitForUserResponse'];

    $this->_dirtyFields = [
      'type' => true,
      'position' => true,
      'edge_order' => true,
      'conversation_config' => true,
      'additional_prompt' => true,
      'additional_knowledge_base' => true,
      'additional_tool_ids' => true,
      'label' => true,
      'message' => true,
      'wait_for_speech_completion' => true,
      'wait_for_user_response' => true
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
      'name' => 'position',
      'contents' => json_encode($this->position),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->edgeOrder as $item) {
      $parts[] = [
        'name' => 'edge_order',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'conversation_config',
      'contents' => json_encode($this->conversationConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'additional_prompt',
      'contents' => $this->additionalPrompt
    ];

    $parts[] = [
      'name' => 'additional_knowledge_base',
      'contents' => json_encode($this->additionalKnowledgeBase),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->additionalToolIds as $item) {
      $parts[] = [
        'name' => 'additional_tool_ids',
        'contents' => $item
      ];
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

    $parts[] = [
      'name' => 'wait_for_speech_completion',
      'contents' => $this->waitForSpeechCompletion ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'wait_for_user_response',
      'contents' => $this->waitForUserResponse ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->position->validate();
    $this->conversationConfig->validate();
    foreach ($this->additionalKnowledgeBase as $item) {
      $item->validate();
    }
  }
}
