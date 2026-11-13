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
class WorkflowOverrideAgentNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutputType>
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
   * Specific goal for this subagent. It will be added to the system prompt and can be used to further refine the agent's behavior in this specific context.
   */
  #[JsonProperty('additional_prompt', required: true)]
  public string $additionalPrompt;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]
   * Additional knowledge base documents that the subagent has access to. These will be used in addition to the main agent's documents.
   */
  #[
    JsonProperty('additional_knowledge_base', required: true),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])
  ]
  public array $additionalKnowledgeBase;

  /**
   * @var string[]
   * IDs of additional tools that the subagent has access to. These will be used in addition to the main agent's tools.
   */
  #[JsonProperty('additional_tool_ids', required: true), ArrayType(['string'])]
  public array $additionalToolIds;

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var value-of<\ElevenLabs\Types\EntryBehavior>
   */
  #[JsonProperty('entry_behavior', required: true)]
  public string $entryBehavior;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowOverrideAgentNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   *   conversationConfig: \ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideOutput,
   *   additionalPrompt: string,
   *   additionalKnowledgeBase: \ElevenLabs\Types\KnowledgeBaseLocator[],
   *   additionalToolIds: string[],
   *   label: string,
   *   entryBehavior: value-of<\ElevenLabs\Types\EntryBehavior>,
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
    $this->entryBehavior = $values['entryBehavior'];

    $this->_dirtyFields = [
      'type' => true,
      'position' => true,
      'edge_order' => true,
      'conversation_config' => true,
      'additional_prompt' => true,
      'additional_knowledge_base' => true,
      'additional_tool_ids' => true,
      'label' => true,
      'entry_behavior' => true
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
      'name' => 'entry_behavior',
      'contents' => $this->entryBehavior
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
