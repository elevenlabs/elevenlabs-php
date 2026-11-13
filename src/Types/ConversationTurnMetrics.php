<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConversationTurnMetrics extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\MetricRecord>|null
   */
  #[JsonProperty('metrics'), ArrayType(['string' => \ElevenLabs\Types\MetricRecord::class])]
  public ?array $metrics;

  #[JsonProperty('convai_asr_provider')]
  public ?string $convaiAsrProvider;

  #[JsonProperty('convai_tts_model')]
  public ?string $convaiTtsModel;

  #[JsonProperty('convai_tts_cascade')]
  public ?string $convaiTtsCascade;

  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * @param array{
   *   metrics?: array<string, \ElevenLabs\Types\MetricRecord>|null,
   *   convaiAsrProvider?: ?string,
   *   convaiTtsModel?: ?string,
   *   convaiTtsCascade?: ?string,
   *   voiceId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->metrics = $values['metrics'] ?? null;
    $this->convaiAsrProvider = $values['convaiAsrProvider'] ?? null;
    $this->convaiTtsModel = $values['convaiTtsModel'] ?? null;
    $this->convaiTtsCascade = $values['convaiTtsCascade'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;

    if (array_key_exists('metrics', $values)) {
      $this->_dirtyFields['metrics'] = true;
    }
    if (array_key_exists('convaiAsrProvider', $values)) {
      $this->_dirtyFields['convai_asr_provider'] = true;
    }
    if (array_key_exists('convaiTtsModel', $values)) {
      $this->_dirtyFields['convai_tts_model'] = true;
    }
    if (array_key_exists('convaiTtsCascade', $values)) {
      $this->_dirtyFields['convai_tts_cascade'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->metrics !== null) {
      $parts[] = [
        'name' => 'metrics',
        'contents' => json_encode($this->metrics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->convaiAsrProvider !== null) {
      $parts[] = [
        'name' => 'convai_asr_provider',
        'contents' => $this->convaiAsrProvider
      ];
    }

    if ($this->convaiTtsModel !== null) {
      $parts[] = [
        'name' => 'convai_tts_model',
        'contents' => $this->convaiTtsModel
      ];
    }

    if ($this->convaiTtsCascade !== null) {
      $parts[] = [
        'name' => 'convai_tts_cascade',
        'contents' => $this->convaiTtsCascade
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
