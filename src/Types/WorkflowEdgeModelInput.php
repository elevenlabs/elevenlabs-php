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
class WorkflowEdgeModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the source node.
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * ID of the target node.
   */
  #[JsonProperty('target', required: true)]
  public string $target;

  /**
   * Condition that must be met for the edge to be traversed in the forward direction (source to target).
   */
  #[JsonProperty('forward_condition')]
  public ?\ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition $forwardCondition;

  /**
   * Condition that must be met for the edge to be traversed in the backward direction (target to source).
   */
  #[JsonProperty('backward_condition')]
  public ?\ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition $backwardCondition;

  /**
   * @var \ElevenLabs\Types\PositionInput[]|null
   * Points the edge is routed through between its source and target, in order. Layout only, no effect on execution.
   */
  #[JsonProperty('reroutes'), ArrayType([\ElevenLabs\Types\PositionInput::class])]
  public ?array $reroutes;

  /**
   * @param array{
   *   source: string,
   *   target: string,
   *   forwardCondition?: ?\ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition,
   *   backwardCondition?: ?\ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition,
   *   reroutes?: \ElevenLabs\Types\PositionInput[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->target = $values['target'];
    $this->forwardCondition = $values['forwardCondition'] ?? null;
    $this->backwardCondition = $values['backwardCondition'] ?? null;
    $this->reroutes = $values['reroutes'] ?? null;

    $this->_dirtyFields = [
      'source' => true,
      'target' => true
    ];
    if (array_key_exists('forwardCondition', $values)) {
      $this->_dirtyFields['forward_condition'] = true;
    }
    if (array_key_exists('backwardCondition', $values)) {
      $this->_dirtyFields['backward_condition'] = true;
    }
    if (array_key_exists('reroutes', $values)) {
      $this->_dirtyFields['reroutes'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
    ];

    $parts[] = [
      'name' => 'target',
      'contents' => $this->target
    ];

    if ($this->forwardCondition !== null) {
      $parts[] = [
        'name' => 'forward_condition',
        'contents' => json_encode($this->forwardCondition),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->backwardCondition !== null) {
      $parts[] = [
        'name' => 'backward_condition',
        'contents' => json_encode($this->backwardCondition),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->reroutes !== null) {
      $parts[] = [
        'name' => 'reroutes',
        'contents' => json_encode($this->reroutes),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->reroutes ?? [] as $item) {
      $item->validate();
    }
  }
}
