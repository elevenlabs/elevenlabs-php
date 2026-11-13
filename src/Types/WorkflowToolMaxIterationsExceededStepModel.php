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
class WorkflowToolMaxIterationsExceededStepModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('step_latency_secs', required: true)]
  public float $stepLatencySecs;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowToolMaxIterationsExceededStepModelType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('max_iterations', required: true)]
  public int $maxIterations;

  /**
   * @param array{
   *   stepLatencySecs: float,
   *   maxIterations: int,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowToolMaxIterationsExceededStepModelType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->stepLatencySecs = $values['stepLatencySecs'];
    $this->type = $values['type'] ?? 'max_iterations_exceeded';
    $this->maxIterations = $values['maxIterations'];

    $this->_dirtyFields = [
      'step_latency_secs' => true,
      'max_iterations' => true
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
      'name' => 'max_iterations',
      'contents' => (string) $this->maxIterations
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
