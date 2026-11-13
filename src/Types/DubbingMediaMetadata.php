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
class DubbingMediaMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The content type of the media.
   */
  #[JsonProperty('content_type', required: true)]
  public string $contentType;

  /**
   * The duration of the media in seconds.
   */
  #[JsonProperty('duration', required: true)]
  public float $duration;

  /**
   * @param array{
   *   contentType: string,
   *   duration: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->contentType = $values['contentType'];
    $this->duration = $values['duration'];

    $this->_dirtyFields = [
      'content_type' => true,
      'duration' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'content_type',
      'contents' => $this->contentType
    ];

    $parts[] = [
      'name' => 'duration',
      'contents' => (string) $this->duration
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
