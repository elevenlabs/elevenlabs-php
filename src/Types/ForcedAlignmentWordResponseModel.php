<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Model representing a single word with its timing information from the aligner.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ForcedAlignmentWordResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The word that was transcribed.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The start time of the word in seconds.
   */
  #[JsonProperty('start', required: true)]
  public float $start;

  /**
   * The end time of the word in seconds.
   */
  #[JsonProperty('end', required: true)]
  public float $end;

  /**
   * The average alignment loss/confidence score for this word, calculated from its constituent characters.
   */
  #[JsonProperty('loss', required: true)]
  public float $loss;

  /**
   * @param array{
   *   text: string,
   *   start: float,
   *   end: float,
   *   loss: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->start = $values['start'];
    $this->end = $values['end'];
    $this->loss = $values['loss'];

    $this->_dirtyFields = [
      'text' => true,
      'start' => true,
      'end' => true,
      'loss' => true
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

    $parts[] = [
      'name' => 'loss',
      'contents' => (string) $this->loss
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
