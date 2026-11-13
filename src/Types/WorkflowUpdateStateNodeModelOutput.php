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
class WorkflowUpdateStateNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutputType>
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

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var \ElevenLabs\Types\WorkflowStateUpdateOutput[]
   * State updates applied when the workflow reaches this node. A node accepts at most 50 updates.
   */
  #[
    JsonProperty('updates', required: true),
    ArrayType([\ElevenLabs\Types\WorkflowStateUpdateOutput::class])
  ]
  public array $updates;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowUpdateStateNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   *   label: string,
   *   updates: \ElevenLabs\Types\WorkflowStateUpdateOutput[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->position = $values['position'];
    $this->edgeOrder = $values['edgeOrder'];
    $this->label = $values['label'];
    $this->updates = $values['updates'];

    $this->_dirtyFields = [
      'type' => true,
      'position' => true,
      'edge_order' => true,
      'label' => true,
      'updates' => true
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
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'updates',
      'contents' => json_encode($this->updates),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->position->validate();
    foreach ($this->updates as $item) {
      $item->validate();
    }
    Validator::validateArray($this->updates, 'updates', maxItems: 50);
  }
}
