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
class PositionInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('x')]
  public ?float $x;

  #[JsonProperty('y')]
  public ?float $y;

  /**
   * @param array{
   *   x?: ?float,
   *   y?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->x = $values['x'] ?? null;
    $this->y = $values['y'] ?? null;

    if (array_key_exists('x', $values)) {
      $this->_dirtyFields['x'] = true;
    }
    if (array_key_exists('y', $values)) {
      $this->_dirtyFields['y'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->x !== null) {
      $parts[] = [
        'name' => 'x',
        'contents' => (string) $this->x
      ];
    }

    if ($this->y !== null) {
      $parts[] = [
        'name' => 'y',
        'contents' => (string) $this->y
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
