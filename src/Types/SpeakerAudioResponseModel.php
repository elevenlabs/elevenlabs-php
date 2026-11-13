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
class SpeakerAudioResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The base64 encoded audio.
   */
  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

  /**
   * The media type of the audio.
   */
  #[JsonProperty('media_type', required: true)]
  public string $mediaType;

  /**
   * The duration of the audio in seconds.
   */
  #[JsonProperty('duration_secs', required: true)]
  public float $durationSecs;

  /**
   * @param array{
   *   audioBase64: string,
   *   mediaType: string,
   *   durationSecs: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioBase64 = $values['audioBase64'];
    $this->mediaType = $values['mediaType'];
    $this->durationSecs = $values['durationSecs'];

    $this->_dirtyFields = [
      'audio_base_64' => true,
      'media_type' => true,
      'duration_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    $parts[] = [
      'name' => 'media_type',
      'contents' => $this->mediaType
    ];

    $parts[] = [
      'name' => 'duration_secs',
      'contents' => (string) $this->durationSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
