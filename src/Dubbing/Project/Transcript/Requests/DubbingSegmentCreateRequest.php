<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Transcript\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A new source segment; its ID and word-level alignment are assigned by the server.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingSegmentCreateRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text of the new segment.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Identifier of the segment's speaker.
   */
  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * Start time of the segment, in seconds.
   */
  #[JsonProperty('start_s', required: true)]
  public float $startS;

  /**
   * End time of the segment, in seconds.
   */
  #[JsonProperty('end_s', required: true)]
  public float $endS;

  /**
   * @param array{
   *   text: string,
   *   speakerId: string,
   *   startS: float,
   *   endS: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->speakerId = $values['speakerId'];
    $this->startS = $values['startS'];
    $this->endS = $values['endS'];

    $this->_dirtyFields = [
      'text' => true,
      'speaker_id' => true,
      'start_s' => true,
      'end_s' => true
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
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    $parts[] = [
      'name' => 'start_s',
      'contents' => (string) $this->startS
    ];

    $parts[] = [
      'name' => 'end_s',
      'contents' => (string) $this->endS
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
