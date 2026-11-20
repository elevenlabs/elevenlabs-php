<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Starts one procedure when the workflow reaches it.
 *
 * A freeform procedure is injected and traversal continues along the node's
 * outgoing edges in the same turn. A structured procedure transfers into its
 * compiled island with this node as the return node; when it ends, the
 * workflow runner hosts this node and evaluates its outgoing edges.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowStartProcedureNodeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowStartProcedureNodeModelInputType>
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
   * ID of the procedure to start when the workflow reaches this node.
   */
  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  /**
   * @param array{
   *   procedureId: string,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowStartProcedureNodeModelInputType>,
   *   position?: ?\ElevenLabs\Types\PositionInput,
   *   edgeOrder?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'start_procedure';
    $this->position = $values['position'] ?? null;
    $this->edgeOrder = $values['edgeOrder'] ?? null;
    $this->procedureId = $values['procedureId'];

    $this->_dirtyFields = [
      'procedure_id' => true
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
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->position?->validate();
    Validator::validateString($this->procedureId, 'procedure_id', minLength: 1);
  }
}
