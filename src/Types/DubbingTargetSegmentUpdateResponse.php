<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The result of a target-translation edit: the updated segment and the new revision.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingTargetSegmentUpdateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * One segment of a target transcript: a source segment plus its translation.
   */
  #[JsonProperty('segment', required: true)]
  public \ElevenLabs\Types\DubbingTargetTranscriptSegment $segment;

  /**
   * The target's revision after this edit.
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * @param array{
   *   segment: \ElevenLabs\Types\DubbingTargetTranscriptSegment,
   *   revision: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->segment = $values['segment'];
    $this->revision = $values['revision'];

    $this->_dirtyFields = [
      'segment' => true,
      'revision' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'segment',
      'contents' => json_encode($this->segment),
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
    $this->segment->validate();
  }
}
