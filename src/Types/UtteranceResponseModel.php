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
class UtteranceResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The start time of the utterance in seconds.
   */
  #[JsonProperty('start', required: true)]
  public float $start;

  /**
   * The end time of the utterance in seconds.
   */
  #[JsonProperty('end', required: true)]
  public float $end;

  /**
   * @param array{
   *   start: float,
   *   end: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->start = $values['start'];
    $this->end = $values['end'];

    $this->_dirtyFields = [
      'start' => true,
      'end' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start',
      'contents' => (string) $this->start
    ];

    $parts[] = [
      'name' => 'end',
      'contents' => (string) $this->end
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
