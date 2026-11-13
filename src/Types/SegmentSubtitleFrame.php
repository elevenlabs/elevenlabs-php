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
class SegmentSubtitleFrame extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_time', required: true)]
  public float $startTime;

  #[JsonProperty('end_time', required: true)]
  public float $endTime;

  /**
   * @var string[]
   */
  #[JsonProperty('lines', required: true), ArrayType(['string'])]
  public array $lines;

  /**
   * @param array{
   *   startTime: float,
   *   endTime: float,
   *   lines: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->lines = $values['lines'];

    $this->_dirtyFields = [
      'start_time' => true,
      'end_time' => true,
      'lines' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_time',
      'contents' => (string) $this->startTime
    ];

    $parts[] = [
      'name' => 'end_time',
      'contents' => (string) $this->endTime
    ];

    foreach ($this->lines as $item) {
      $parts[] = [
        'name' => 'lines',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
