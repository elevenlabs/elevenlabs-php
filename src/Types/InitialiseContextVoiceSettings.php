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
class InitialiseContextVoiceSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('stability')]
  public ?float $stability;

  #[JsonProperty('similarity_boost')]
  public ?float $similarityBoost;

  #[JsonProperty('style')]
  public ?float $style;

  #[JsonProperty('use_speaker_boost')]
  public ?bool $useSpeakerBoost;

  #[JsonProperty('speed')]
  public ?float $speed;

  /**
   * @param array{
   *   stability?: ?float,
   *   similarityBoost?: ?float,
   *   style?: ?float,
   *   useSpeakerBoost?: ?bool,
   *   speed?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->stability = $values['stability'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->style = $values['style'] ?? null;
    $this->useSpeakerBoost = $values['useSpeakerBoost'] ?? null;
    $this->speed = $values['speed'] ?? null;

    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('similarityBoost', $values)) {
      $this->_dirtyFields['similarity_boost'] = true;
    }
    if (array_key_exists('style', $values)) {
      $this->_dirtyFields['style'] = true;
    }
    if (array_key_exists('useSpeakerBoost', $values)) {
      $this->_dirtyFields['use_speaker_boost'] = true;
    }
    if (array_key_exists('speed', $values)) {
      $this->_dirtyFields['speed'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->stability !== null) {
      $parts[] = [
        'name' => 'stability',
        'contents' => (string) $this->stability
      ];
    }

    if ($this->similarityBoost !== null) {
      $parts[] = [
        'name' => 'similarity_boost',
        'contents' => (string) $this->similarityBoost
      ];
    }

    if ($this->style !== null) {
      $parts[] = [
        'name' => 'style',
        'contents' => (string) $this->style
      ];
    }

    if ($this->useSpeakerBoost !== null) {
      $parts[] = [
        'name' => 'use_speaker_boost',
        'contents' => $this->useSpeakerBoost ? 'true' : 'false'
      ];
    }

    if ($this->speed !== null) {
      $parts[] = [
        'name' => 'speed',
        'contents' => (string) $this->speed
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
