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
class PodcastConversationModeData extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the host voice.
   */
  #[JsonProperty('host_voice_id', required: true)]
  public string $hostVoiceId;

  /**
   * The ID of the guest voice.
   */
  #[JsonProperty('guest_voice_id', required: true)]
  public string $guestVoiceId;

  /**
   * @param array{
   *   hostVoiceId: string,
   *   guestVoiceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->hostVoiceId = $values['hostVoiceId'];
    $this->guestVoiceId = $values['guestVoiceId'];

    $this->_dirtyFields = [
      'host_voice_id' => true,
      'guest_voice_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'host_voice_id',
      'contents' => $this->hostVoiceId
    ];

    $parts[] = [
      'name' => 'guest_voice_id',
      'contents' => $this->guestVoiceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
