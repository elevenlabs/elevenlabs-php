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
class BodyTranscribesSegmentsV1DubbingResourceDubbingIdTranscribePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * Transcribe this specific list of segments.
   */
  #[JsonProperty('segments', required: true), ArrayType(['string'])]
  public array $segments;

  /**
   * @param array{
   *   segments: string[],
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
    foreach ($this->segments as $item) {
      $parts[] = [
        'name' => 'segments',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
