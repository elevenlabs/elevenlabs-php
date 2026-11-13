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
class Model extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the model.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * The name of the model.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * Whether the model can be finetuned.
   */
  #[JsonProperty('can_be_finetuned')]
  public ?bool $canBeFinetuned;

  /**
   * Whether the model can do text-to-speech.
   */
  #[JsonProperty('can_do_text_to_speech')]
  public ?bool $canDoTextToSpeech;

  /**
   * Whether the model can do voice conversion.
   */
  #[JsonProperty('can_do_voice_conversion')]
  public ?bool $canDoVoiceConversion;

  /**
   * Whether the model can use style.
   */
  #[JsonProperty('can_use_style')]
  public ?bool $canUseStyle;

  /**
   * Whether the model can use speaker boost.
   */
  #[JsonProperty('can_use_speaker_boost')]
  public ?bool $canUseSpeakerBoost;

  /**
   * Whether the model serves pro voices.
   */
  #[JsonProperty('serves_pro_voices')]
  public ?bool $servesProVoices;

  /**
   * The cost factor for the model.
   */
  #[JsonProperty('token_cost_factor')]
  public ?float $tokenCostFactor;

  /**
   * The description of the model.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Whether the model requires alpha access.
   */
  #[JsonProperty('requires_alpha_access')]
  public ?bool $requiresAlphaAccess;

  /**
   * Deprecated. Not enforced; use `maximum_text_length_per_request` instead.
   */
  #[JsonProperty('max_characters_request_free_user')]
  public ?int $maxCharactersRequestFreeUser;

  /**
   * Deprecated. Not enforced; use `maximum_text_length_per_request` instead.
   */
  #[JsonProperty('max_characters_request_subscribed_user')]
  public ?int $maxCharactersRequestSubscribedUser;

  /**
   * The maximum number of input text characters accepted per request for this model. Longer requests are rejected.
   */
  #[JsonProperty('maximum_text_length_per_request')]
  public ?int $maximumTextLengthPerRequest;

  /**
   * @var \ElevenLabs\Types\LanguageResponse[]|null
   * The languages supported by the model.
   */
  #[JsonProperty('languages'), ArrayType([\ElevenLabs\Types\LanguageResponse::class])]
  public ?array $languages;

  #[JsonProperty('model_rates')]
  public ?\ElevenLabs\Types\ModelRatesResponseModel $modelRates;

  /**
   * The concurrency group for the model.
   */
  #[JsonProperty('concurrency_group')]
  public ?string $concurrencyGroup;

  /**
   * @param array{
   *   modelId: string,
   *   name?: ?string,
   *   canBeFinetuned?: ?bool,
   *   canDoTextToSpeech?: ?bool,
   *   canDoVoiceConversion?: ?bool,
   *   canUseStyle?: ?bool,
   *   canUseSpeakerBoost?: ?bool,
   *   servesProVoices?: ?bool,
   *   tokenCostFactor?: ?float,
   *   description?: ?string,
   *   requiresAlphaAccess?: ?bool,
   *   maxCharactersRequestFreeUser?: ?int,
   *   maxCharactersRequestSubscribedUser?: ?int,
   *   maximumTextLengthPerRequest?: ?int,
   *   languages?: \ElevenLabs\Types\LanguageResponse[]|null,
   *   modelRates?: ?\ElevenLabs\Types\ModelRatesResponseModel,
   *   concurrencyGroup?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->modelId = $values['modelId'];
    $this->name = $values['name'] ?? null;
    $this->canBeFinetuned = $values['canBeFinetuned'] ?? null;
    $this->canDoTextToSpeech = $values['canDoTextToSpeech'] ?? null;
    $this->canDoVoiceConversion = $values['canDoVoiceConversion'] ?? null;
    $this->canUseStyle = $values['canUseStyle'] ?? null;
    $this->canUseSpeakerBoost = $values['canUseSpeakerBoost'] ?? null;
    $this->servesProVoices = $values['servesProVoices'] ?? null;
    $this->tokenCostFactor = $values['tokenCostFactor'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->requiresAlphaAccess = $values['requiresAlphaAccess'] ?? null;
    $this->maxCharactersRequestFreeUser = $values['maxCharactersRequestFreeUser'] ?? null;
    $this->maxCharactersRequestSubscribedUser =
      $values['maxCharactersRequestSubscribedUser'] ?? null;
    $this->maximumTextLengthPerRequest = $values['maximumTextLengthPerRequest'] ?? null;
    $this->languages = $values['languages'] ?? null;
    $this->modelRates = $values['modelRates'] ?? null;
    $this->concurrencyGroup = $values['concurrencyGroup'] ?? null;

    $this->_dirtyFields = [
      'model_id' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('canBeFinetuned', $values)) {
      $this->_dirtyFields['can_be_finetuned'] = true;
    }
    if (array_key_exists('canDoTextToSpeech', $values)) {
      $this->_dirtyFields['can_do_text_to_speech'] = true;
    }
    if (array_key_exists('canDoVoiceConversion', $values)) {
      $this->_dirtyFields['can_do_voice_conversion'] = true;
    }
    if (array_key_exists('canUseStyle', $values)) {
      $this->_dirtyFields['can_use_style'] = true;
    }
    if (array_key_exists('canUseSpeakerBoost', $values)) {
      $this->_dirtyFields['can_use_speaker_boost'] = true;
    }
    if (array_key_exists('servesProVoices', $values)) {
      $this->_dirtyFields['serves_pro_voices'] = true;
    }
    if (array_key_exists('tokenCostFactor', $values)) {
      $this->_dirtyFields['token_cost_factor'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('requiresAlphaAccess', $values)) {
      $this->_dirtyFields['requires_alpha_access'] = true;
    }
    if (array_key_exists('maxCharactersRequestFreeUser', $values)) {
      $this->_dirtyFields['max_characters_request_free_user'] = true;
    }
    if (array_key_exists('maxCharactersRequestSubscribedUser', $values)) {
      $this->_dirtyFields['max_characters_request_subscribed_user'] = true;
    }
    if (array_key_exists('maximumTextLengthPerRequest', $values)) {
      $this->_dirtyFields['maximum_text_length_per_request'] = true;
    }
    if (array_key_exists('languages', $values)) {
      $this->_dirtyFields['languages'] = true;
    }
    if (array_key_exists('modelRates', $values)) {
      $this->_dirtyFields['model_rates'] = true;
    }
    if (array_key_exists('concurrencyGroup', $values)) {
      $this->_dirtyFields['concurrency_group'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->canBeFinetuned !== null) {
      $parts[] = [
        'name' => 'can_be_finetuned',
        'contents' => $this->canBeFinetuned ? 'true' : 'false'
      ];
    }

    if ($this->canDoTextToSpeech !== null) {
      $parts[] = [
        'name' => 'can_do_text_to_speech',
        'contents' => $this->canDoTextToSpeech ? 'true' : 'false'
      ];
    }

    if ($this->canDoVoiceConversion !== null) {
      $parts[] = [
        'name' => 'can_do_voice_conversion',
        'contents' => $this->canDoVoiceConversion ? 'true' : 'false'
      ];
    }

    if ($this->canUseStyle !== null) {
      $parts[] = [
        'name' => 'can_use_style',
        'contents' => $this->canUseStyle ? 'true' : 'false'
      ];
    }

    if ($this->canUseSpeakerBoost !== null) {
      $parts[] = [
        'name' => 'can_use_speaker_boost',
        'contents' => $this->canUseSpeakerBoost ? 'true' : 'false'
      ];
    }

    if ($this->servesProVoices !== null) {
      $parts[] = [
        'name' => 'serves_pro_voices',
        'contents' => $this->servesProVoices ? 'true' : 'false'
      ];
    }

    if ($this->tokenCostFactor !== null) {
      $parts[] = [
        'name' => 'token_cost_factor',
        'contents' => (string) $this->tokenCostFactor
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->requiresAlphaAccess !== null) {
      $parts[] = [
        'name' => 'requires_alpha_access',
        'contents' => $this->requiresAlphaAccess ? 'true' : 'false'
      ];
    }

    if ($this->maxCharactersRequestFreeUser !== null) {
      $parts[] = [
        'name' => 'max_characters_request_free_user',
        'contents' => (string) $this->maxCharactersRequestFreeUser
      ];
    }

    if ($this->maxCharactersRequestSubscribedUser !== null) {
      $parts[] = [
        'name' => 'max_characters_request_subscribed_user',
        'contents' => (string) $this->maxCharactersRequestSubscribedUser
      ];
    }

    if ($this->maximumTextLengthPerRequest !== null) {
      $parts[] = [
        'name' => 'maximum_text_length_per_request',
        'contents' => (string) $this->maximumTextLengthPerRequest
      ];
    }

    if ($this->languages !== null) {
      $parts[] = [
        'name' => 'languages',
        'contents' => json_encode($this->languages),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->modelRates !== null) {
      $parts[] = [
        'name' => 'model_rates',
        'contents' => json_encode($this->modelRates),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->concurrencyGroup !== null) {
      $parts[] = [
        'name' => 'concurrency_group',
        'contents' => $this->concurrencyGroup
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->languages ?? [] as $item) {
      $item->validate();
    }
    $this->modelRates?->validate();
  }
}
