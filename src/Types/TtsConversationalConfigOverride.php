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
class TtsConversationalConfigOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsConversationalModel>
   * The model to use for TTS
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * The voice ID to use for TTS
   */
  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * @var \ElevenLabs\Types\SupportedVoice[]|null
   * Additional supported voices for the agent
   */
  #[JsonProperty('supported_voices'), ArrayType([\ElevenLabs\Types\SupportedVoice::class])]
  public ?array $supportedVoices;

  /**
   * The stability of generated speech
   */
  #[JsonProperty('stability')]
  public ?float $stability;

  /**
   * The speed of generated speech
   */
  #[JsonProperty('speed')]
  public ?float $speed;

  /**
   * The similarity boost for generated speech
   */
  #[JsonProperty('similarity_boost')]
  public ?float $similarityBoost;

  /**
   * The clone strength for generated speech
   */
  #[JsonProperty('clone_strength')]
  public ?float $cloneStrength;

  /**
   * @var \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator[]|null
   * The pronunciation dictionary locators
   */
  #[
    JsonProperty('pronunciation_dictionary_locators'),
    ArrayType([\ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator::class])
  ]
  public ?array $pronunciationDictionaryLocators;

  /**
   * @param array{
   *   modelId?: ?value-of<\ElevenLabs\Types\TtsConversationalModel>,
   *   voiceId?: ?string,
   *   supportedVoices?: \ElevenLabs\Types\SupportedVoice[]|null,
   *   stability?: ?float,
   *   speed?: ?float,
   *   similarityBoost?: ?float,
   *   cloneStrength?: ?float,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator[]|null,
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
        'contents' => $this->modelId
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->supportedVoices !== null) {
      $parts[] = [
        'name' => 'supported_voices',
        'contents' => json_encode($this->supportedVoices),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->stability !== null) {
      $parts[] = [
        'name' => 'stability',
        'contents' => (string) $this->stability
      ];
    }

    if ($this->speed !== null) {
      $parts[] = [
        'name' => 'speed',
        'contents' => (string) $this->speed
      ];
    }

    if ($this->similarityBoost !== null) {
      $parts[] = [
        'name' => 'similarity_boost',
        'contents' => (string) $this->similarityBoost
      ];
    }

    if ($this->cloneStrength !== null) {
      $parts[] = [
        'name' => 'clone_strength',
        'contents' => (string) $this->cloneStrength
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->supportedVoices ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
  }
}
