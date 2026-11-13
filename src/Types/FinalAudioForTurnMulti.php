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
class FinalAudioForTurnMulti extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Signals the end of audio for a turn. Emitted after each explicit flush, new_turn/voice-switch boundary, and on connection close. All of the turn's audio, including any bytes buffered by streaming codecs (MP3, Opus, etc.), is delivered before this marker.
   */
  #[JsonProperty('is_final_audio_for_turn')]
  public ?bool $isFinalAudioForTurn;

  /**
   * Identifies which context this response belongs to. Only set on the multi-context endpoint; omitted (None) on the single-context endpoint.
   */
  #[JsonProperty('context_id')]
  public ?string $contextId;

  /**
   * @param array{
   *   isFinalAudioForTurn?: ?bool,
   *   contextId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isFinalAudioForTurn = $values['isFinalAudioForTurn'] ?? null;
    $this->contextId = $values['contextId'] ?? null;

    if (array_key_exists('isFinalAudioForTurn', $values)) {
      $this->_dirtyFields['is_final_audio_for_turn'] = true;
    }
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
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

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
