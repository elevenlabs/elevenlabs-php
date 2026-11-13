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
class ConversationVoiceUsageModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  #[JsonProperty('audio_output_seconds')]
  public ?float $audioOutputSeconds;

  /**
   * @param array{
   *   voiceId: string,
   *   audioOutputSeconds?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->audioOutputSeconds = $values['audioOutputSeconds'] ?? null;

    $this->_dirtyFields = [
      'voice_id' => true
    ];
    if (array_key_exists('audioOutputSeconds', $values)) {
      $this->_dirtyFields['audio_output_seconds'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    if ($this->audioOutputSeconds !== null) {
      $parts[] = [
        'name' => 'audio_output_seconds',
        'contents' => (string) $this->audioOutputSeconds
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
