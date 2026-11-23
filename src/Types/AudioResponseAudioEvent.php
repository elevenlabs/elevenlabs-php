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
class AudioResponseAudioEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * Character-level timing data for the audio chunk, useful for synchronized text display or lip-syncing.
   */
  #[JsonProperty('alignment')]
  public ?\ElevenLabs\Types\AudioResponseAudioEventAlignment $alignment;

  /**
   * Whether this is the last audio chunk of the current agent response.
   */
  #[JsonProperty('is_final')]
  public ?bool $isFinal;

  /**
   * @param array{
   *   audioBase64: string,
   *   eventId: int,
   *   alignment?: ?\ElevenLabs\Types\AudioResponseAudioEventAlignment,
   *   isFinal?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioBase64 = $values['audioBase64'];
    $this->eventId = $values['eventId'];
    $this->alignment = $values['alignment'] ?? null;
    $this->isFinal = $values['isFinal'] ?? null;

    $this->_dirtyFields = [
      'audio_base_64' => true,
      'event_id' => true
    ];
    if (array_key_exists('alignment', $values)) {
      $this->_dirtyFields['alignment'] = true;
    }
    if (array_key_exists('isFinal', $values)) {
      $this->_dirtyFields['is_final'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    if ($this->alignment !== null) {
      $parts[] = [
        'name' => 'alignment',
        'contents' => json_encode($this->alignment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isFinal !== null) {
      $parts[] = [
        'name' => 'is_final',
        'contents' => $this->isFinal ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->alignment?->validate();
  }
}
