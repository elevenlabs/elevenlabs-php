<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeech\Requests;

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
class StreamTextToSpeechWithTimestampsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
   * 0 - default mode (no latency optimizations)
   * 1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
   * 2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
   * 3 - max latency optimizations
   * 4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).
   *
   * Defaults to None.
   *
   */
  public ?int $optimizeStreamingLatency;

  /**
   * @var ?value-of<\ElevenLabs\TextToSpeech\Types\StreamWithTimestampsTextToSpeechRequestOutputFormat>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * The text that will get converted into speech.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

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
   * Voice settings overriding stored settings for the given voice. They are applied only on the given request.
   */
  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\VoiceSettings $voiceSettings;

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
   * The text that came before the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
   */
  #[JsonProperty('previous_text')]
  public ?string $previousText;

  /**
   * The text that comes after the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
   */
  #[JsonProperty('next_text')]
  public ?string $nextText;

  /**
   * @var string[]|null
   * A list of request_id of the samples that were generated before this generation. Can be used to improve the speech's continuity when splitting up a large task into multiple requests. The results will be best when the same model is used across the generations. In case both previous_text and previous_request_ids is send, previous_text will be ignored. A maximum of 3 request_ids can be sent.
   */
  #[JsonProperty('previous_request_ids'), ArrayType(['string'])]
  public ?array $previousRequestIds;

  /**
   * @var string[]|null
   * A list of request_id of the samples that come after this generation. next_request_ids is especially useful for maintaining the speech's continuity when regenerating a sample that has had some audio quality issues. For example, if you have generated 3 speech clips, and you want to improve clip 2, passing the request id of clip 3 as a next_request_id (and that of clip 1 as a previous_request_id) will help maintain natural flow in the combined speech. The results will be best when the same model is used across the generations. In case both next_text and next_request_ids is send, next_text will be ignored. A maximum of 3 request_ids can be sent.
   */
  #[JsonProperty('next_request_ids'), ArrayType(['string'])]
  public ?array $nextRequestIds;

  /**
   * Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
   */
  #[JsonProperty('use_pvc_as_ivc')]
  public ?bool $usePvcAsIvc;

  /**
   * @var ?value-of<\ElevenLabs\TextToSpeech\Types\BodyTextToSpeechStreamWithTimestampsApplyTextNormalization>
   * This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
   */
  #[JsonProperty('apply_text_normalization')]
  public ?string $applyTextNormalization;

  /**
   * This parameter controls language text normalization. This helps with proper pronunciation of text in some supported languages. WARNING: This parameter can heavily increase the latency of the request. Currently only supported for Japanese.
   */
  #[JsonProperty('apply_language_text_normalization')]
  public ?bool $applyLanguageTextNormalization;

  /**
   * Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_``, `alaw_``, and `pcm_*` output formats. Effects don't change the cost of the request.
   */
  #[JsonProperty('audio_effects')]
  public ?\ElevenLabs\Types\EffectsSpecInput $audioEffects;

  /**
   * @param array{
   *   text: string,
   *   enableLogging?: ?bool,
   *   optimizeStreamingLatency?: ?int,
   *   outputFormat?: ?value-of<\ElevenLabs\TextToSpeech\Types\StreamWithTimestampsTextToSpeechRequestOutputFormat>,
   *   modelId?: ?string,
   *   languageCode?: ?string,
   *   voiceSettings?: ?\ElevenLabs\Types\VoiceSettings,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]|null,
   *   seed?: ?int,
   *   previousText?: ?string,
   *   nextText?: ?string,
   *   previousRequestIds?: string[]|null,
   *   nextRequestIds?: string[]|null,
   *   usePvcAsIvc?: ?bool,
   *   applyTextNormalization?: ?value-of<\ElevenLabs\TextToSpeech\Types\BodyTextToSpeechStreamWithTimestampsApplyTextNormalization>,
   *   applyLanguageTextNormalization?: ?bool,
   *   audioEffects?: ?\ElevenLabs\Types\EffectsSpecInput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->optimizeStreamingLatency = $values['optimizeStreamingLatency'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->text = $values['text'];
    $this->modelId = $values['modelId'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->previousText = $values['previousText'] ?? null;
    $this->nextText = $values['nextText'] ?? null;
    $this->previousRequestIds = $values['previousRequestIds'] ?? null;
    $this->nextRequestIds = $values['nextRequestIds'] ?? null;
    $this->usePvcAsIvc = $values['usePvcAsIvc'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->applyLanguageTextNormalization = $values['applyLanguageTextNormalization'] ?? null;
    $this->audioEffects = $values['audioEffects'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('languageCode', $values)) {
      $this->_dirtyFields['language_code'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('previousText', $values)) {
      $this->_dirtyFields['previous_text'] = true;
    }
    if (array_key_exists('nextText', $values)) {
      $this->_dirtyFields['next_text'] = true;
    }
    if (array_key_exists('previousRequestIds', $values)) {
      $this->_dirtyFields['previous_request_ids'] = true;
    }
    if (array_key_exists('nextRequestIds', $values)) {
      $this->_dirtyFields['next_request_ids'] = true;
    }
    if (array_key_exists('usePvcAsIvc', $values)) {
      $this->_dirtyFields['use_pvc_as_ivc'] = true;
    }
    if (array_key_exists('applyTextNormalization', $values)) {
      $this->_dirtyFields['apply_text_normalization'] = true;
    }
    if (array_key_exists('applyLanguageTextNormalization', $values)) {
      $this->_dirtyFields['apply_language_text_normalization'] = true;
    }
    if (array_key_exists('audioEffects', $values)) {
      $this->_dirtyFields['audio_effects'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
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

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => json_encode($this->voiceSettings),
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

    if ($this->previousText !== null) {
      $parts[] = [
        'name' => 'previous_text',
        'contents' => $this->previousText
      ];
    }

    if ($this->nextText !== null) {
      $parts[] = [
        'name' => 'next_text',
        'contents' => $this->nextText
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

    if ($this->usePvcAsIvc !== null) {
      $parts[] = [
        'name' => 'use_pvc_as_ivc',
        'contents' => $this->usePvcAsIvc ? 'true' : 'false'
      ];
    }

    if ($this->applyTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_text_normalization',
        'contents' => $this->applyTextNormalization
      ];
    }

    if ($this->applyLanguageTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_language_text_normalization',
        'contents' => $this->applyLanguageTextNormalization ? 'true' : 'false'
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
    $this->voiceSettings?->validate();
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
    $this->audioEffects?->validate();
  }
}
