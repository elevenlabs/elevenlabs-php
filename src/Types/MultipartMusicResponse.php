<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Multipart response structure with JSON metadata and binary audio
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MultipartMusicResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Response model for structured music generation endpoint
   */
  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\DetailedMusicResponse $metadata;

  /**
   * @var string
   * Binary audio data in the requested format
   */
  #[JsonProperty('audio', required: true)]
  public string $audio;

  /**
   * @param array{
   *   metadata: \ElevenLabs\Types\DetailedMusicResponse,
   *   audio: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->metadata = $values['metadata'];
    $this->audio = $values['audio'];

    $this->_dirtyFields = [
      'metadata' => true,
      'audio' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'audio',
      'contents' => $this->audio
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->metadata->validate();
  }
}
