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
class WorkflowOverrideAgentNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInputType>
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
   * Specific goal for this subagent. It will be added to the system prompt and can be used to further refine the agent's behavior in this specific context.
   */
  #[JsonProperty('additional_prompt')]
  public ?string $additionalPrompt;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]|null
   * Additional knowledge base documents that the subagent has access to. These will be used in addition to the main agent's documents.
   */
  #[
    JsonProperty('additional_knowledge_base'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])
  ]
  public ?array $additionalKnowledgeBase;

  /**
   * @var string[]|null
   * IDs of additional tools that the subagent has access to. These will be used in addition to the main agent's tools.
   */
  #[JsonProperty('additional_tool_ids'), ArrayType(['string'])]
  public ?array $additionalToolIds;

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var ?value-of<\ElevenLabs\Types\EntryBehavior>
   */
  #[JsonProperty('entry_behavior')]
  public ?string $entryBehavior;

  /**
   * @param array{
   *   label: string,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowOverrideAgentNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   *   conversationConfig?: ?\ElevenLabs\Types\ConversationalConfigApiModelWorkflowOverrideInput,
   *   additionalPrompt?: ?string,
   *   additionalKnowledgeBase?: \ElevenLabs\Types\KnowledgeBaseLocator[]|null,
   *   additionalToolIds?: string[]|null,
   *   entryBehavior?: ?value-of<\ElevenLabs\Types\EntryBehavior>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'override_agent';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->conversationConfig = $values['conversationConfig'] ?? null;
    $this->additionalPrompt = $values['additionalPrompt'] ?? null;
    $this->additionalKnowledgeBase = $values['additionalKnowledgeBase'] ?? null;
    $this->additionalToolIds = $values['additionalToolIds'] ?? null;
    $this->label = $values['label'];
    $this->entryBehavior = $values['entryBehavior'] ?? null;

    $this->_dirtyFields = [
      'label' => true
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
    if (array_key_exists('entryBehavior', $values)) {
      $this->_dirtyFields['entry_behavior'] = true;
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

    if ($this->entryBehavior !== null) {
      $parts[] = [
        'name' => 'entry_behavior',
        'contents' => $this->entryBehavior
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
