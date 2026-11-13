<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Aggregated TTS usage for a conversation (analytics-only, not billing).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationTtsUsageModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('primary_tts_model')]
  public ?string $primaryTtsModel;

  #[JsonProperty('total_audio_output_seconds')]
  public ?float $totalAudioOutputSeconds;

  #[JsonProperty('total_characters')]
  public ?int $totalCharacters;

  /**
   * @var \ElevenLabs\Types\ConversationVoiceUsageModel[]|null
   */
  #[
    JsonProperty('per_voice_usage'),
    ArrayType([\ElevenLabs\Types\ConversationVoiceUsageModel::class])
  ]
  public ?array $perVoiceUsage;

  /**
   * @param array{
   *   primaryTtsModel?: ?string,
   *   totalAudioOutputSeconds?: ?float,
   *   totalCharacters?: ?int,
   *   perVoiceUsage?: \ElevenLabs\Types\ConversationVoiceUsageModel[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->primaryTtsModel = $values['primaryTtsModel'] ?? null;
    $this->totalAudioOutputSeconds = $values['totalAudioOutputSeconds'] ?? null;
    $this->totalCharacters = $values['totalCharacters'] ?? null;
    $this->perVoiceUsage = $values['perVoiceUsage'] ?? null;

    if (array_key_exists('primaryTtsModel', $values)) {
      $this->_dirtyFields['primary_tts_model'] = true;
    }
    if (array_key_exists('totalAudioOutputSeconds', $values)) {
      $this->_dirtyFields['total_audio_output_seconds'] = true;
    }
    if (array_key_exists('totalCharacters', $values)) {
      $this->_dirtyFields['total_characters'] = true;
    }
    if (array_key_exists('perVoiceUsage', $values)) {
      $this->_dirtyFields['per_voice_usage'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->primaryTtsModel !== null) {
      $parts[] = [
        'name' => 'primary_tts_model',
        'contents' => $this->primaryTtsModel
      ];
    }

    if ($this->totalAudioOutputSeconds !== null) {
      $parts[] = [
        'name' => 'total_audio_output_seconds',
        'contents' => (string) $this->totalAudioOutputSeconds
      ];
    }

    if ($this->totalCharacters !== null) {
      $parts[] = [
        'name' => 'total_characters',
        'contents' => (string) $this->totalCharacters
      ];
    }

    if ($this->perVoiceUsage !== null) {
      $parts[] = [
        'name' => 'per_voice_usage',
        'contents' => json_encode($this->perVoiceUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->perVoiceUsage ?? [] as $item) {
      $item->validate();
    }
  }
}
