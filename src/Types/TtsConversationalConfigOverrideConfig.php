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
class TtsConversationalConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the model_id field.
   */
  #[JsonProperty('model_id')]
  public ?bool $modelId;

  /**
   * Whether to allow overriding the voice_id field.
   */
  #[JsonProperty('voice_id')]
  public ?bool $voiceId;

  /**
   * Whether to allow overriding the supported_voices field.
   */
  #[JsonProperty('supported_voices')]
  public ?bool $supportedVoices;

  /**
   * Whether to allow overriding the stability field.
   */
  #[JsonProperty('stability')]
  public ?bool $stability;

  /**
   * Whether to allow overriding the speed field.
   */
  #[JsonProperty('speed')]
  public ?bool $speed;

  /**
   * Whether to allow overriding the similarity_boost field.
   */
  #[JsonProperty('similarity_boost')]
  public ?bool $similarityBoost;

  /**
   * Whether to allow overriding the clone_strength field.
   */
  #[JsonProperty('clone_strength')]
  public ?bool $cloneStrength;

  /**
   * Whether to allow overriding the pronunciation_dictionary_locators field.
   */
  #[JsonProperty('pronunciation_dictionary_locators')]
  public ?bool $pronunciationDictionaryLocators;

  /**
   * @param array{
   *   modelId?: ?bool,
   *   voiceId?: ?bool,
   *   supportedVoices?: ?bool,
   *   stability?: ?bool,
   *   speed?: ?bool,
   *   similarityBoost?: ?bool,
   *   cloneStrength?: ?bool,
   *   pronunciationDictionaryLocators?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->modelId = $values['modelId'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->supportedVoices = $values['supportedVoices'] ?? null;
    $this->stability = $values['stability'] ?? null;
    $this->speed = $values['speed'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->cloneStrength = $values['cloneStrength'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;

    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('supportedVoices', $values)) {
      $this->_dirtyFields['supported_voices'] = true;
    }
    if (array_key_exists('stability', $values)) {
      $this->_dirtyFields['stability'] = true;
    }
    if (array_key_exists('speed', $values)) {
      $this->_dirtyFields['speed'] = true;
    }
    if (array_key_exists('similarityBoost', $values)) {
      $this->_dirtyFields['similarity_boost'] = true;
    }
    if (array_key_exists('cloneStrength', $values)) {
      $this->_dirtyFields['clone_strength'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId ? 'true' : 'false'
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId ? 'true' : 'false'
      ];
    }

    if ($this->supportedVoices !== null) {
      $parts[] = [
        'name' => 'supported_voices',
        'contents' => $this->supportedVoices ? 'true' : 'false'
      ];
    }

    if ($this->stability !== null) {
      $parts[] = [
        'name' => 'stability',
        'contents' => $this->stability ? 'true' : 'false'
      ];
    }

    if ($this->speed !== null) {
      $parts[] = [
        'name' => 'speed',
        'contents' => $this->speed ? 'true' : 'false'
      ];
    }

    if ($this->similarityBoost !== null) {
      $parts[] = [
        'name' => 'similarity_boost',
        'contents' => $this->similarityBoost ? 'true' : 'false'
      ];
    }

    if ($this->cloneStrength !== null) {
      $parts[] = [
        'name' => 'clone_strength',
        'contents' => $this->cloneStrength ? 'true' : 'false'
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => $this->pronunciationDictionaryLocators ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
