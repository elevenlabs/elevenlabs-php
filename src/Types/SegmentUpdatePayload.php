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
class SegmentUpdatePayload extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_time')]
  public ?float $startTime;

  #[JsonProperty('end_time')]
  public ?float $endTime;

  #[JsonProperty('text')]
  public ?string $text;

  /**
   * @param array{
   *   startTime?: ?float,
   *   endTime?: ?float,
   *   text?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->startTime = $values['startTime'] ?? null;
    $this->endTime = $values['endTime'] ?? null;
    $this->text = $values['text'] ?? null;

    if (array_key_exists('startTime', $values)) {
      $this->_dirtyFields['start_time'] = true;
    }
    if (array_key_exists('endTime', $values)) {
      $this->_dirtyFields['end_time'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->startTime !== null) {
      $parts[] = [
        'name' => 'start_time',
        'contents' => (string) $this->startTime
      ];
    }

    if ($this->endTime !== null) {
      $parts[] = [
        'name' => 'end_time',
        'contents' => (string) $this->endTime
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
