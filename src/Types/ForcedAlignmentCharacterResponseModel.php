<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Model representing a single character with its timing information from the aligner.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ForcedAlignmentCharacterResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The character that was transcribed.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The start time of the character in seconds.
   */
  #[JsonProperty('start', required: true)]
  public float $start;

  /**
   * The end time of the character in seconds.
   */
  #[JsonProperty('end', required: true)]
  public float $end;

  /**
   * @param array{
   *   text: string,
   *   start: float,
   *   end: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->start = $values['start'];
    $this->end = $values['end'];

    $this->_dirtyFields = [
      'text' => true,
      'start' => true,
      'end' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

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
