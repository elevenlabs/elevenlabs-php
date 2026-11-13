<?php

declare(strict_types=1);

namespace ElevenLabs\TextToDialogue\Requests;

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
class BodyTextToDialogueStreamWithTimestamps extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AllowedOutputFormats>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * @var \ElevenLabs\Types\DialogueInput[]
   * A list of dialogue inputs, each containing text and a voice ID which will be converted into speech. The maximum number of unique voice IDs is 10. For reliable generation, keep the total character count across all `inputs[].text` values at or below 2,000 characters per request. Longer requests can terminate early in streaming responses or return a validation error.
   */
  #[JsonProperty('inputs', required: true), ArrayType([\ElevenLabs\Types\DialogueInput::class])]
  public array $inputs;

  /**
   * Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
   */
  #[JsonProperty('language_code')]
  public ?string $languageCode;

  /**
   * Settings controlling the dialogue generation.
   */
  #[JsonProperty('settings')]
  public ?\ElevenLabs\Types\ToDialogueSettingsResponseModel $settings;

  /**
   * @var \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]|null
   * A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
   */
  #[
    JsonProperty('pronunciation_dictionary_locators'),
    ArrayType([\ElevenLabs\Types\PronunciationDictionaryVersionLocator::class])
  ]
  public ?array $pronunciationDictionaryLocators;

  /**
   * If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * @var ?value-of<\ElevenLabs\TextToDialogue\Types\BodyTextToDialogueStreamWithTimestampsApplyTextNormalization>
   * This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
   */
  #[JsonProperty('apply_text_normalization')]
  public ?string $applyTextNormalization;

  /**
   * Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
   */
  #[JsonProperty('use_pvc_as_ivc')]
  public ?bool $usePvcAsIvc;

  /**
   * @var string[]|null
   * A list of request_ids of dialogue generations that came before this one. Used to condition the model for continuity when splitting a large task into multiple requests. A maximum of 3 request_ids can be sent. The last request_id is the audio which is closest to the current request. Not supported by every model.
   */
  #[JsonProperty('previous_request_ids'), ArrayType(['string'])]
  public ?array $previousRequestIds;

  /**
   * @var string[]|null
   * A list of request_ids of dialogue generations that come after this one. Useful for maintaining continuity when regenerating a clip in the middle of a sequence. A maximum of 3 request_ids can be sent. The first request_id is the audio which is closest to the current request. Not supported by every model.
   */
  #[JsonProperty('next_request_ids'), ArrayType(['string'])]
  public ?array $nextRequestIds;

  /**
   * The text that comes immediately before this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
   */
  #[JsonProperty('previous_text')]
  public ?string $previousText;

  /**
   * The text that comes immediately after this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
   */
  #[JsonProperty('future_text')]
  public ?string $futureText;

  /**
   * Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_``, `alaw_``, and `pcm_*` output formats. Effects don't change the cost of the request.
   */
  #[JsonProperty('audio_effects')]
  public ?\ElevenLabs\Types\EffectsSpecInput $audioEffects;

  /**
   * @param array{
   *   inputs: \ElevenLabs\Types\DialogueInput[],
   *   outputFormat?: ?value-of<\ElevenLabs\Types\AllowedOutputFormats>,
   *   enableLogging?: ?bool,
   *   modelId?: ?string,
   *   languageCode?: ?string,
   *   settings?: ?\ElevenLabs\Types\ToDialogueSettingsResponseModel,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]|null,
   *   seed?: ?int,
   *   applyTextNormalization?: ?value-of<\ElevenLabs\TextToDialogue\Types\BodyTextToDialogueStreamWithTimestampsApplyTextNormalization>,
   *   usePvcAsIvc?: ?bool,
   *   previousRequestIds?: string[]|null,
   *   nextRequestIds?: string[]|null,
   *   previousText?: ?string,
   *   futureText?: ?string,
   *   audioEffects?: ?\ElevenLabs\Types\EffectsSpecInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->inputs = $values['inputs'];
    $this->modelId = $values['modelId'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->settings = $values['settings'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->usePvcAsIvc = $values['usePvcAsIvc'] ?? null;
    $this->previousRequestIds = $values['previousRequestIds'] ?? null;
    $this->nextRequestIds = $values['nextRequestIds'] ?? null;
    $this->previousText = $values['previousText'] ?? null;
    $this->futureText = $values['futureText'] ?? null;
    $this->audioEffects = $values['audioEffects'] ?? null;

    $this->_dirtyFields = [
      'inputs' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('languageCode', $values)) {
      $this->_dirtyFields['language_code'] = true;
    }
    if (array_key_exists('settings', $values)) {
      $this->_dirtyFields['settings'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('applyTextNormalization', $values)) {
      $this->_dirtyFields['apply_text_normalization'] = true;
    }
    if (array_key_exists('usePvcAsIvc', $values)) {
      $this->_dirtyFields['use_pvc_as_ivc'] = true;
    }
    if (array_key_exists('previousRequestIds', $values)) {
      $this->_dirtyFields['previous_request_ids'] = true;
    }
    if (array_key_exists('nextRequestIds', $values)) {
      $this->_dirtyFields['next_request_ids'] = true;
    }
    if (array_key_exists('previousText', $values)) {
      $this->_dirtyFields['previous_text'] = true;
    }
    if (array_key_exists('futureText', $values)) {
      $this->_dirtyFields['future_text'] = true;
    }
    if (array_key_exists('audioEffects', $values)) {
      $this->_dirtyFields['audio_effects'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'inputs',
      'contents' => json_encode($this->inputs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->languageCode !== null) {
      $parts[] = [
        'name' => 'language_code',
        'contents' => $this->languageCode
      ];
    }

    if ($this->settings !== null) {
      $parts[] = [
        'name' => 'settings',
        'contents' => json_encode($this->settings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->applyTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_text_normalization',
        'contents' => $this->applyTextNormalization
      ];
    }

    if ($this->usePvcAsIvc !== null) {
      $parts[] = [
        'name' => 'use_pvc_as_ivc',
        'contents' => $this->usePvcAsIvc ? 'true' : 'false'
      ];
    }

    if ($this->previousRequestIds !== null) {
      foreach ($this->previousRequestIds ?? [] as $item) {
        $parts[] = [
          'name' => 'previous_request_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->nextRequestIds !== null) {
      foreach ($this->nextRequestIds ?? [] as $item) {
        $parts[] = [
          'name' => 'next_request_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->previousText !== null) {
      $parts[] = [
        'name' => 'previous_text',
        'contents' => $this->previousText
      ];
    }

    if ($this->futureText !== null) {
      $parts[] = [
        'name' => 'future_text',
        'contents' => $this->futureText
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
    foreach ($this->inputs as $item) {
      $item->validate();
    }
    $this->settings?->validate();
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
    Validator::validateString($this->previousText, 'previous_text', maxLength: 100);
    Validator::validateString($this->futureText, 'future_text', maxLength: 100);
    $this->audioEffects?->validate();
  }
}
