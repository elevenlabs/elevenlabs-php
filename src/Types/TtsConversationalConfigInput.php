<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TtsConversationalConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsConversationalModel>
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
   * When enabled, applies expressive audio tags prompt. Automatically disabled for non-v3 models.
   */
  #[JsonProperty('expressive_mode')]
  public ?bool $expressiveMode;

  /**
   * @var \ElevenLabs\Types\SuggestedAudioTag[]|null
   * Suggested audio tags to boost expressive speech (for eleven_v3 and eleven_v3_conversational models). The agent can still use other tags not listed here.
   */
  #[JsonProperty('suggested_audio_tags'), ArrayType([\ElevenLabs\Types\SuggestedAudioTag::class])]
  public ?array $suggestedAudioTags;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsOutputFormat>
   */
  #[JsonProperty('agent_output_audio_format')]
  public ?string $agentOutputAudioFormat;

  /**
   * @var ?value-of<\ElevenLabs\Types\TtsOptimizeStreamingLatency>
   */
  #[JsonProperty('optimize_streaming_latency')]
  public ?int $optimizeStreamingLatency;

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
   * @var ?value-of<\ElevenLabs\Types\TextNormalisationType>
   * Method for converting numbers to words before sending to TTS
   */
  #[JsonProperty('text_normalisation_type')]
  public ?string $textNormalisationType;

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
   * Opt-in to SSML phoneme tag handling for V3 models. When enabled, phoneme tags (inline and from pronunciation dictionaries) are parsed into inline IPA before being sent to the model.
   */
  #[JsonProperty('enable_phoneme_tags')]
  public ?bool $enablePhonemeTags;

  /**
   * Optional TTS effects spec: filter preset, distance (proximity EQ), and environment (convolution reverb).
   */
  #[JsonProperty('audio_effects')]
  public ?\ElevenLabs\Types\EffectsSpecInput $audioEffects;

  /**
   * @param array{
   *   modelId?: ?value-of<\ElevenLabs\Types\TtsConversationalModel>,
   *   voiceId?: ?string,
   *   supportedVoices?: \ElevenLabs\Types\SupportedVoice[]|null,
   *   expressiveMode?: ?bool,
   *   suggestedAudioTags?: \ElevenLabs\Types\SuggestedAudioTag[]|null,
   *   agentOutputAudioFormat?: ?value-of<\ElevenLabs\Types\TtsOutputFormat>,
   *   optimizeStreamingLatency?: ?value-of<\ElevenLabs\Types\TtsOptimizeStreamingLatency>,
   *   stability?: ?float,
   *   speed?: ?float,
   *   similarityBoost?: ?float,
   *   cloneStrength?: ?float,
   *   textNormalisationType?: ?value-of<\ElevenLabs\Types\TextNormalisationType>,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator[]|null,
   *   enablePhonemeTags?: ?bool,
   *   audioEffects?: ?\ElevenLabs\Types\EffectsSpecInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->modelId = $values['modelId'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->supportedVoices = $values['supportedVoices'] ?? null;
    $this->expressiveMode = $values['expressiveMode'] ?? null;
    $this->suggestedAudioTags = $values['suggestedAudioTags'] ?? null;
    $this->agentOutputAudioFormat = $values['agentOutputAudioFormat'] ?? null;
    $this->optimizeStreamingLatency = $values['optimizeStreamingLatency'] ?? null;
    $this->stability = $values['stability'] ?? null;
    $this->speed = $values['speed'] ?? null;
    $this->similarityBoost = $values['similarityBoost'] ?? null;
    $this->cloneStrength = $values['cloneStrength'] ?? null;
    $this->textNormalisationType = $values['textNormalisationType'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->enablePhonemeTags = $values['enablePhonemeTags'] ?? null;
    $this->audioEffects = $values['audioEffects'] ?? null;

    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('supportedVoices', $values)) {
      $this->_dirtyFields['supported_voices'] = true;
    }
    if (array_key_exists('expressiveMode', $values)) {
      $this->_dirtyFields['expressive_mode'] = true;
    }
    if (array_key_exists('suggestedAudioTags', $values)) {
      $this->_dirtyFields['suggested_audio_tags'] = true;
    }
    if (array_key_exists('agentOutputAudioFormat', $values)) {
      $this->_dirtyFields['agent_output_audio_format'] = true;
    }
    if (array_key_exists('optimizeStreamingLatency', $values)) {
      $this->_dirtyFields['optimize_streaming_latency'] = true;
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
    if (array_key_exists('textNormalisationType', $values)) {
      $this->_dirtyFields['text_normalisation_type'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('enablePhonemeTags', $values)) {
      $this->_dirtyFields['enable_phoneme_tags'] = true;
    }
    if (array_key_exists('audioEffects', $values)) {
      $this->_dirtyFields['audio_effects'] = true;
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

    if ($this->expressiveMode !== null) {
      $parts[] = [
        'name' => 'expressive_mode',
        'contents' => $this->expressiveMode ? 'true' : 'false'
      ];
    }

    if ($this->suggestedAudioTags !== null) {
      $parts[] = [
        'name' => 'suggested_audio_tags',
        'contents' => json_encode($this->suggestedAudioTags),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->agentOutputAudioFormat !== null) {
      $parts[] = [
        'name' => 'agent_output_audio_format',
        'contents' => $this->agentOutputAudioFormat
      ];
    }

    if ($this->optimizeStreamingLatency !== null) {
      $parts[] = [
        'name' => 'optimize_streaming_latency',
        'contents' => (string) $this->optimizeStreamingLatency
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

    if ($this->textNormalisationType !== null) {
      $parts[] = [
        'name' => 'text_normalisation_type',
        'contents' => $this->textNormalisationType
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->enablePhonemeTags !== null) {
      $parts[] = [
        'name' => 'enable_phoneme_tags',
        'contents' => $this->enablePhonemeTags ? 'true' : 'false'
      ];
    }

    if ($this->audioEffects !== null) {
      $parts[] = [
        'name' => 'audio_effects',
        'contents' => json_encode($this->audioEffects),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->voiceId, 'voice_id', minLength: 0);
    foreach ($this->supportedVoices ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->suggestedAudioTags ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->suggestedAudioTags, 'suggested_audio_tags', maxItems: 20);
    Validator::validateNumber($this->stability, 'stability', min: 0, max: 1);
    Validator::validateNumber($this->speed, 'speed', min: 0.7, max: 1.2);
    Validator::validateNumber($this->similarityBoost, 'similarity_boost', min: 0, max: 1);
    Validator::validateNumber($this->cloneStrength, 'clone_strength', min: 0, max: 1);
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
    $this->audioEffects?->validate();
  }
}
