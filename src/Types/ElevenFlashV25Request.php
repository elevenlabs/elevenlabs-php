<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Request body for the ElevenLabs Flash v2.5 TTS model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ElevenFlashV25Request extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Include to send the generation's result to the workspace's configured flows webhooks once it completes or fails. The webhook payload matches the terminal response of the corresponding GET endpoint.
   */
  #[JsonProperty('webhook')]
  public ?\ElevenLabs\Types\WebhookTarget $webhook;

  /**
   * The text to synthesize into speech.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The ID of the voice to speak with.
   */
  #[JsonProperty('voice', required: true)]
  public string $voice;

  /**
   * @var ?value-of<\ElevenLabs\Types\ElevenFlashV25RequestOutputFormat>
   * The audio encoding of the output, as `codec_sampleRateHz_bitrateKbps`. `mp3_44100_192` requires the Creator tier or above.
   */
  #[JsonProperty('output_format')]
  public ?string $outputFormat;

  /**
   * @var \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]|null
   * Pronunciation dictionaries to apply to the text, in order of precedence. Up to 3.
   */
  #[
    JsonProperty('pronunciation_dictionary_locators'),
    ArrayType([\ElevenLabs\Types\PronunciationDictionaryVersionLocator::class])
  ]
  public ?array $pronunciationDictionaryLocators;

  /**
   * @var value-of<\ElevenLabs\Types\ElevenFlashV25RequestModelId>
   * The model to use for the generation.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * ISO 639-1 language code to enforce on the output. Omit to detect the language from the text.
   */
  #[JsonProperty('language_code')]
  public ?string $languageCode;

  /**
   * Overrides for the voice's saved settings, applied to this generation only.
   */
  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\ElevenFlashV25VoiceSettings $voiceSettings;

  /**
   * @param array{
   *   text: string,
   *   voice: string,
   *   modelId: value-of<\ElevenLabs\Types\ElevenFlashV25RequestModelId>,
   *   webhook?: ?\ElevenLabs\Types\WebhookTarget,
   *   outputFormat?: ?value-of<\ElevenLabs\Types\ElevenFlashV25RequestOutputFormat>,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\PronunciationDictionaryVersionLocator[]|null,
   *   languageCode?: ?string,
   *   voiceSettings?: ?\ElevenLabs\Types\ElevenFlashV25VoiceSettings,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->webhook = $values['webhook'] ?? null;
    $this->text = $values['text'];
    $this->voice = $values['voice'];
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->modelId = $values['modelId'];
    $this->languageCode = $values['languageCode'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;

    $this->_dirtyFields = [
      'text' => true,
      'voice' => true,
      'model_id' => true
    ];
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('outputFormat', $values)) {
      $this->_dirtyFields['output_format'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('languageCode', $values)) {
      $this->_dirtyFields['language_code'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->webhook !== null) {
      $parts[] = [
        'name' => 'webhook',
        'contents' => json_encode($this->webhook),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'voice',
      'contents' => $this->voice
    ];

    if ($this->outputFormat !== null) {
      $parts[] = [
        'name' => 'output_format',
        'contents' => $this->outputFormat
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

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

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray(
      $this->pronunciationDictionaryLocators,
      'pronunciation_dictionary_locators',
      maxItems: 3
    );
    $this->voiceSettings?->validate();
  }
}
