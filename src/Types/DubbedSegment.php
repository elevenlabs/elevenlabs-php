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
class DubbedSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('start_time', required: true)]
  public float $startTime;

  #[JsonProperty('end_time', required: true)]
  public float $endTime;

  #[JsonProperty('text', required: true)]
  public ?string $text;

  /**
   * @var \ElevenLabs\Types\SegmentSubtitleFrame[]
   */
  #[
    JsonProperty('subtitles', required: true),
    ArrayType([\ElevenLabs\Types\SegmentSubtitleFrame::class])
  ]
  public array $subtitles;

  #[JsonProperty('audio_stale', required: true)]
  public bool $audioStale;

  #[JsonProperty('media_ref', required: true)]
  public ?\ElevenLabs\Types\DubbingMediaReference $mediaRef;

  /**
   * @param array{
   *   startTime: float,
   *   endTime: float,
   *   text: ?string,
   *   subtitles: \ElevenLabs\Types\SegmentSubtitleFrame[],
   *   audioStale: bool,
   *   mediaRef: ?\ElevenLabs\Types\DubbingMediaReference,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->text = $values['text'];
    $this->subtitles = $values['subtitles'];
    $this->audioStale = $values['audioStale'];
    $this->mediaRef = $values['mediaRef'];

    $this->_dirtyFields = [
      'start_time' => true,
      'end_time' => true,
      'text' => true,
      'subtitles' => true,
      'audio_stale' => true,
      'media_ref' => true
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

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'subtitles',
      'contents' => json_encode($this->subtitles),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'audio_stale',
      'contents' => $this->audioStale ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'media_ref',
      'contents' => json_encode($this->mediaRef),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->subtitles as $item) {
      $item->validate();
    }
    $this->mediaRef?->validate();
  }
}
