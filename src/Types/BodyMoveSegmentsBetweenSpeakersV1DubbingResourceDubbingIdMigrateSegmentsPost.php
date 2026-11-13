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
class BodyMoveSegmentsBetweenSpeakersV1DubbingResourceDubbingIdMigrateSegmentsPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('segment_ids', required: true), ArrayType(['string'])]
  public array $segmentIds;

  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * @param array{
   *   segmentIds: string[],
   *   speakerId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->segmentIds = $values['segmentIds'];
    $this->speakerId = $values['speakerId'];

    $this->_dirtyFields = [
      'segment_ids' => true,
      'speaker_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->segmentIds as $item) {
      $parts[] = [
        'name' => 'segment_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
