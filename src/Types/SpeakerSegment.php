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
class SpeakerSegment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('start_time', required: true)]
  public float $startTime;

  #[JsonProperty('end_time', required: true)]
  public float $endTime;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var \ElevenLabs\Types\SegmentSubtitleFrame[]
   */
  #[
    JsonProperty('subtitles', required: true),
    ArrayType([\ElevenLabs\Types\SegmentSubtitleFrame::class])
  ]
  public array $subtitles;

  /**
   * @var array<string, \ElevenLabs\Types\DubbedSegment>
   */
  #[
    JsonProperty('dubs', required: true),
    ArrayType(['string' => \ElevenLabs\Types\DubbedSegment::class])
  ]
  public array $dubs;

  /**
   * @param array{
   *   id: string,
   *   startTime: float,
   *   endTime: float,
   *   text: string,
   *   subtitles: \ElevenLabs\Types\SegmentSubtitleFrame[],
   *   dubs: array<string, \ElevenLabs\Types\DubbedSegment>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->text = $values['text'];
    $this->subtitles = $values['subtitles'];
    $this->dubs = $values['dubs'];

    $this->_dirtyFields = [
      'id' => true,
      'start_time' => true,
      'end_time' => true,
      'text' => true,
      'subtitles' => true,
      'dubs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

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
      'name' => 'dubs',
      'contents' => json_encode($this->dubs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->subtitles as $item) {
      $item->validate();
    }
  }
}
