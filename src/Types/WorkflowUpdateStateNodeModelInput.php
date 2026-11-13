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
class WorkflowUpdateStateNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowUpdateStateNodeModelInputType>
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

  /**
   * Human-readable label for the node used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var \ElevenLabs\Types\WorkflowStateUpdateInput[]
   * State updates applied when the workflow reaches this node. A node accepts at most 50 updates.
   */
  #[
    JsonProperty('updates', required: true),
    ArrayType([\ElevenLabs\Types\WorkflowStateUpdateInput::class])
  ]
  public array $updates;

  /**
   * @param array{
   *   label: string,
   *   updates: \ElevenLabs\Types\WorkflowStateUpdateInput[],
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowUpdateStateNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'update_state';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->label = $values['label'];
    $this->updates = $values['updates'];

    $this->_dirtyFields = [
      'label' => true,
      'updates' => true
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
    $this->position?->validate();
    foreach ($this->updates as $item) {
      $item->validate();
    }
    Validator::validateArray($this->updates, 'updates', maxItems: 50);
  }
}
