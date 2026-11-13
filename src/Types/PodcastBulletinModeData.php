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
class PodcastBulletinModeData extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the host voice.
   */
  #[JsonProperty('host_voice_id', required: true)]
  public string $hostVoiceId;

  /**
   * @param array{
   *   hostVoiceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->hostVoiceId = $values['hostVoiceId'];

    $this->_dirtyFields = [
      'host_voice_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'host_voice_id',
      'contents' => $this->hostVoiceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
