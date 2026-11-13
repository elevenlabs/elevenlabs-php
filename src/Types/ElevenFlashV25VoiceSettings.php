<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Overrides for the voice's saved settings, applied to one generation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ElevenFlashV25VoiceSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How consistent the voice stays across generations. Lower values give more expressive, varied speech.
   */
  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * How closely the output adheres to the original voice.
   */
  #[JsonProperty('similarity_boost')]
  public ?float $similarityBoost;

  /**
   * The speed of the generated speech, where 1.0 is the voice's natural pace.
   */
  #[JsonProperty('speed')]
  public ?float $speed;

  /**
   * @param array{
   *   stability?: ?float,
   *   similarityBoost?: ?float,
   *   speed?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->stability = $values['stability'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->speed = $values['speed'] ?? null;

    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('similarityBoost', $values)) {
      $this->_dirtyFields['similarity_boost'] = true;
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
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
    Validator::validateNumber($this->similarityBoost, 'similarity_boost', min: 0, max: 1);
    Validator::validateNumber($this->speed, 'speed', min: 0.7, max: 1.2);
  }
}
