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
class FinalAudioForTurn extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Signals the end of audio for a turn. Emitted after each explicit flush, new_turn/voice-switch boundary, and on connection close. All of the turn's audio, including any bytes buffered by streaming codecs (MP3, Opus, etc.), is delivered before this marker.
   */
  #[JsonProperty('is_final_audio_for_turn')]
  public ?bool $isFinalAudioForTurn;

  /**
   * @param array{
   *   isFinalAudioForTurn?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isFinalAudioForTurn = $values['isFinalAudioForTurn'] ?? null;

    if (array_key_exists('isFinalAudioForTurn', $values)) {
      $this->_dirtyFields['is_final_audio_for_turn'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isFinalAudioForTurn !== null) {
      $parts[] = [
        'name' => 'is_final_audio_for_turn',
        'contents' => $this->isFinalAudioForTurn ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
