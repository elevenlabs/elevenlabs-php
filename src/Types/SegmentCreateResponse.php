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
class SegmentCreateResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('new_segment', required: true)]
  public string $newSegment;

  /**
   * @param array{
   *   version: int,
   *   newSegment: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->version = $values['version'];
    $this->newSegment = $values['newSegment'];

    $this->_dirtyFields = [
      'version' => true,
      'new_segment' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    $parts[] = [
      'name' => 'new_segment',
      'contents' => $this->newSegment
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
