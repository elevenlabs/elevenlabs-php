<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A partial update to a source segment; omitted fields are left unchanged.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingSegmentUpdateRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * New text for the segment.
   */
  #[JsonProperty('text')]
  public ?string $text;

  /**
   * New speaker ID for the segment.
   */
  #[JsonProperty('speaker_id')]
  public ?string $speakerId;

  /**
   * New start time, in seconds.
   */
  #[JsonProperty('start_s')]
  public ?float $startS;

  /**
   * New end time, in seconds.
   */
  #[JsonProperty('end_s')]
  public ?float $endS;

  /**
   * @param array{
   *   text?: ?string,
   *   speakerId?: ?string,
   *   startS?: ?float,
   *   endS?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->text = $values['text'] ?? null;
    $this->speakerId = $values['speakerId'] ?? null;
    $this->startS = $values['startS'] ?? null;
    $this->endS = $values['endS'] ?? null;

    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('speakerId', $values)) {
      $this->_dirtyFields['speaker_id'] = true;
    }
    if (array_key_exists('startS', $values)) {
      $this->_dirtyFields['start_s'] = true;
    }
    if (array_key_exists('endS', $values)) {
      $this->_dirtyFields['end_s'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->speakerId !== null) {
      $parts[] = [
        'name' => 'speaker_id',
        'contents' => $this->speakerId
      ];
    }

    if ($this->startS !== null) {
      $parts[] = [
        'name' => 'start_s',
        'contents' => (string) $this->startS
      ];
    }

    if ($this->endS !== null) {
      $parts[] = [
        'name' => 'end_s',
        'contents' => (string) $this->endS
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
