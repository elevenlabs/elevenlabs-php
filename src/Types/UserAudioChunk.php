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
class UserAudioChunk extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Base64-encoded audio data from the user's microphone.
   */
  #[JsonProperty('user_audio_chunk', required: true)]
  public string $userAudioChunk;

  /**
   * @param array{
   *   userAudioChunk: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userAudioChunk = $values['userAudioChunk'];

    $this->_dirtyFields = [
      'user_audio_chunk' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_audio_chunk',
      'contents' => $this->userAudioChunk
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
