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
class MetricRecord extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('elapsed_time', required: true)]
  public float $elapsedTime;

  /**
   * @param array{
   *   elapsedTime: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->elapsedTime = $values['elapsedTime'];

    $this->_dirtyFields = [
      'elapsed_time' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'elapsed_time',
      'contents' => (string) $this->elapsedTime
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
