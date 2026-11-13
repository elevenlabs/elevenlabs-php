<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkflowToolEdgeStepModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('step_latency_secs', required: true)]
  public float $stepLatencySecs;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowToolEdgeStepModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('edge_id', required: true)]
  public string $edgeId;

  #[JsonProperty('target_node_id', required: true)]
  public string $targetNodeId;

  /**
   * @param array{
   *   stepLatencySecs: float,
   *   edgeId: string,
   *   targetNodeId: string,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowToolEdgeStepModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->stepLatencySecs = $values['stepLatencySecs'];
    $this->type = $values['type'] ?? 'edge';
    $this->edgeId = $values['edgeId'];
    $this->targetNodeId = $values['targetNodeId'];

    $this->_dirtyFields = [
      'step_latency_secs' => true,
      'edge_id' => true,
      'target_node_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'step_latency_secs',
      'contents' => (string) $this->stepLatencySecs
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'edge_id',
      'contents' => $this->edgeId
    ];

    $parts[] = [
      'name' => 'target_node_id',
      'contents' => $this->targetNodeId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
