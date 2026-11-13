<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * One segment of a source transcript.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingTranscriptSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable identifier of the segment, used to address it in edit requests.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The transcribed text of the segment.
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
   * The caller-supplied external ID for this segment, if one was provided.
   */
  #[JsonProperty('external_id')]
  public ?string $externalId;

  /**
   * @param array{
   *   id: string,
   *   text: string,
   *   speakerId: string,
   *   startS: float,
   *   endS: float,
   *   externalId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->text = $values['text'];
    $this->speakerId = $values['speakerId'];
    $this->startS = $values['startS'];
    $this->endS = $values['endS'];
    $this->externalId = $values['externalId'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'text' => true,
      'speaker_id' => true,
      'start_s' => true,
      'end_s' => true
    ];
    if (array_key_exists('externalId', $values)) {
      $this->_dirtyFields['external_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

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

    if ($this->externalId !== null) {
      $parts[] = [
        'name' => 'external_id',
        'contents' => $this->externalId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
