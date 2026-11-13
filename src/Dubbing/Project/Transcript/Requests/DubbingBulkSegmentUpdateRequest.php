<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Transcript\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Edit several source segments at once, applied atomically (all succeed or none do).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingBulkSegmentUpdateRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\DubbingSegmentUpdateRequest>
   * Map of segment ID to the partial update to apply to that segment. At least one entry and at most 500.
   */
  #[
    JsonProperty('segments', required: true),
    ArrayType(['string' => \ElevenLabs\Types\DubbingSegmentUpdateRequest::class])
  ]
  public array $segments;

  /**
   * @param array{
   *   segments: array<string, \ElevenLabs\Types\DubbingSegmentUpdateRequest>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->segments = $values['segments'];

    $this->_dirtyFields = [
      'segments' => true
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
