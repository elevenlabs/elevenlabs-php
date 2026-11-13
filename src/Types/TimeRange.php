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
class TimeRange extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_ms', required: true)]
  public int $startMs;

  #[JsonProperty('end_ms', required: true)]
  public int $endMs;

  /**
   * @param array{
   *   startMs: int,
   *   endMs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startMs = $values['startMs'];
    $this->endMs = $values['endMs'];

    $this->_dirtyFields = [
      'start_ms' => true,
      'end_ms' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_ms',
      'contents' => (string) $this->startMs
    ];

    $parts[] = [
      'name' => 'end_ms',
      'contents' => (string) $this->endMs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
