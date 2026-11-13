<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Aggregated ASR usage for a conversation (analytics-only, not billing).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationAsrUsageModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('asr_model')]
  public ?string $asrModel;

  #[JsonProperty('total_transcription_calls')]
  public ?int $totalTranscriptionCalls;

  #[JsonProperty('total_audio_input_seconds')]
  public ?float $totalAudioInputSeconds;

  /**
   * @param array{
   *   asrModel?: ?string,
   *   totalTranscriptionCalls?: ?int,
   *   totalAudioInputSeconds?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->asrModel = $values['asrModel'] ?? null;
    $this->totalTranscriptionCalls = $values['totalTranscriptionCalls'] ?? null;
    $this->totalAudioInputSeconds = $values['totalAudioInputSeconds'] ?? null;

    if (array_key_exists('asrModel', $values)) {
      $this->_dirtyFields['asr_model'] = true;
    }
    if (array_key_exists('totalTranscriptionCalls', $values)) {
      $this->_dirtyFields['total_transcription_calls'] = true;
    }
    if (array_key_exists('totalAudioInputSeconds', $values)) {
      $this->_dirtyFields['total_audio_input_seconds'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->asrModel !== null) {
      $parts[] = [
        'name' => 'asr_model',
        'contents' => $this->asrModel
      ];
    }

    if ($this->totalTranscriptionCalls !== null) {
      $parts[] = [
        'name' => 'total_transcription_calls',
        'contents' => (string) $this->totalTranscriptionCalls
      ];
    }

    if ($this->totalAudioInputSeconds !== null) {
      $parts[] = [
        'name' => 'total_audio_input_seconds',
        'contents' => (string) $this->totalAudioInputSeconds
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
