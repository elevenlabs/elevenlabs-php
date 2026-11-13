<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class VoiceSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Determines how stable the voice is and the randomness between each generation. Lower values introduce broader emotional range for the voice. Higher values can result in a monotonous voice with limited emotion.
   */
  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * This setting boosts the similarity to the original speaker. Using this setting requires a slightly higher computational load, which in turn increases latency.
   */
  #[JsonProperty('use_speaker_boost')]
  public ?bool $useSpeakerBoost;

  /**
   * Determines how closely the AI should adhere to the original voice when attempting to replicate it.
   */
  #[JsonProperty('similarity_boost')]
  public ?float $similarityBoost;

  /**
   * Determines the style exaggeration of the voice. This setting attempts to amplify the style of the original speaker. It does consume additional computational resources and might increase latency if set to anything other than 0.
   */
  #[JsonProperty('style')]
  public ?float $style;

  /**
   * Adjusts the speed of the voice. A value of 1.0 is the default speed, while values less than 1.0 slow down the speech, and values greater than 1.0 speed it up.
   */
  #[JsonProperty('speed')]
  public ?float $speed;

  /**
   * Controls how closely the output matches your professional voice clone samples (0–1). Lower values sound more versatile, while higher values preserve more of the original voice characteristics. We recommend 0 for most use cases, but if you do run into issues 0.5 could be a good fallback. Applies only to professional voice clones fine-tuned for the selected v4 model.
   */
  #[JsonProperty('clone_strength')]
  public ?float $cloneStrength;

  /**
   * @param array{
   *   stability?: ?float,
   *   useSpeakerBoost?: ?bool,
   *   similarityBoost?: ?float,
   *   style?: ?float,
   *   speed?: ?float,
   *   cloneStrength?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->stability = $values['stability'] ?? null;
    $this->useSpeakerBoost = $values['useSpeakerBoost'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->style = $values['style'] ?? null;
    $this->speed = $values['speed'] ?? null;
    $this->cloneStrength = $values['cloneStrength'] ?? null;

    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('useSpeakerBoost', $values)) {
      $this->_dirtyFields['use_speaker_boost'] = true;
    }
    if (array_key_exists('similarityBoost', $values)) {
      $this->_dirtyFields['similarity_boost'] = true;
    }
    if (array_key_exists('style', $values)) {
      $this->_dirtyFields['style'] = true;
    }
    if (array_key_exists('speed', $values)) {
      $this->_dirtyFields['speed'] = true;
    }
    if (array_key_exists('cloneStrength', $values)) {
      $this->_dirtyFields['clone_strength'] = true;
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

    if ($this->useSpeakerBoost !== null) {
      $parts[] = [
        'name' => 'use_speaker_boost',
        'contents' => $this->useSpeakerBoost ? 'true' : 'false'
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

    if ($this->speed !== null) {
      $parts[] = [
        'name' => 'speed',
        'contents' => (string) $this->speed
      ];
    }

    if ($this->cloneStrength !== null) {
      $parts[] = [
        'name' => 'clone_strength',
        'contents' => (string) $this->cloneStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
    Validator::validateNumber($this->similarityBoost, 'similarity_boost', min: 0, max: 1);
    Validator::validateNumber($this->cloneStrength, 'clone_strength', min: 0, max: 1);
  }
}
