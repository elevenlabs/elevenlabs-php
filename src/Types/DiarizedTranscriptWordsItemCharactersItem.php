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
class DiarizedTranscriptWordsItemCharactersItem extends JsonSerializableType
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
  #[JsonProperty('start')]
  public ?float $start;

  /**
   * The end time of the character in seconds.
   */
  #[JsonProperty('end')]
  public ?float $end;

  /**
   * @param array{
   *   text: string,
   *   start?: ?float,
   *   end?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->start = $values['start'] ?? null;
    $this->end = $values['end'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('start', $values)) {
      $this->_dirtyFields['start'] = true;
    }
    if (array_key_exists('end', $values)) {
      $this->_dirtyFields['end'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->start !== null) {
      $parts[] = [
        'name' => 'start',
        'contents' => (string) $this->start
      ];
    }

    if ($this->end !== null) {
      $parts[] = [
        'name' => 'end',
        'contents' => (string) $this->end
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
