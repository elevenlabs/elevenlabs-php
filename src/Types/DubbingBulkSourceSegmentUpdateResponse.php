<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The result of a bulk source edit: the updated segments and the new revision.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingBulkSourceSegmentUpdateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\DubbingTranscriptSegment[]
   * The edited segments in their updated state.
   */
  #[
    JsonProperty('segments', required: true),
    ArrayType([\ElevenLabs\Types\DubbingTranscriptSegment::class])
  ]
  public array $segments;

  /**
   * The project's source-transcript revision after the edits.
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * @param array{
   *   segments: \ElevenLabs\Types\DubbingTranscriptSegment[],
   *   revision: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->segments = $values['segments'];
    $this->revision = $values['revision'];

    $this->_dirtyFields = [
      'segments' => true,
      'revision' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'segments',
      'contents' => json_encode($this->segments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'revision',
      'contents' => (string) $this->revision
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->segments as $item) {
      $item->validate();
    }
  }
}
