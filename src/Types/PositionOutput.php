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
class PositionOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('x', required: true)]
  public float $x;

  #[JsonProperty('y', required: true)]
  public float $y;

  /**
   * @param array{
   *   x: float,
   *   y: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->x = $values['x'];
    $this->y = $values['y'];

    $this->_dirtyFields = [
      'x' => true,
      'y' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'x',
      'contents' => (string) $this->x
    ];

    $parts[] = [
      'name' => 'y',
      'contents' => (string) $this->y
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
