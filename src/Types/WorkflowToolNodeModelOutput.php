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
class WorkflowToolNodeModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowToolNodeModelOutputType>
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
   * @var \ElevenLabs\Types\WorkflowToolLocator[]
   * List of tools to execute in parallel. The entire node is considered successful if all tools are executed successfully.
   */
  #[
    JsonProperty('tools', required: true),
    ArrayType([\ElevenLabs\Types\WorkflowToolLocator::class])
  ]
  public array $tools;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\WorkflowToolNodeModelOutputType>,
   *   position: \ElevenLabs\Types\PositionOutput,
   *   edgeOrder: string[],
   *   tools: \ElevenLabs\Types\WorkflowToolLocator[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->position = $values['position'];
    $this->edgeOrder = $values['edgeOrder'];
    $this->tools = $values['tools'];

    $this->_dirtyFields = [
      'type' => true,
      'position' => true,
      'edge_order' => true,
      'tools' => true
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
      'name' => 'tools',
      'contents' => json_encode($this->tools),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->position->validate();
    foreach ($this->tools as $item) {
      $item->validate();
    }
  }
}
