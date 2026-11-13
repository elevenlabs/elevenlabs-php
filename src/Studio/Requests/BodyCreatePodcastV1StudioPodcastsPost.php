<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreatePodcastV1StudioPodcastsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Used for moderation. Your workspace must be allowlisted to use this feature.
   */
  public ?string $safetyIdentifier;

  /**
   * The ID of the model to be used for this Studio project, you can query GET /v1/models to list all available models.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * The type of podcast to generate. Can be 'conversation', an interaction between two voices, or 'bulletin', a monologue.
   */
  #[JsonProperty('mode', required: true)]
  public \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostMode $mode;

  /**
   * The source content for the Podcast.
   */
  #[
    JsonProperty('source', required: true),
    Union(\ElevenLabs\Types\PodcastTextSource::class, \ElevenLabs\Types\PodcastUrlSource::class, [
      \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostSourceTwoItem::class
    ])
  ]
  public \ElevenLabs\Types\PodcastTextSource|\ElevenLabs\Types\PodcastUrlSource|array $source;

  /**
   * @var ?value-of<\ElevenLabs\Types\QualityPresetType>
   * Output quality of the generated audio. Must be one of:
   * 'standard' - standard output format, 128kbps with 44.1kHz sample rate.
   * 'high' - high quality output format, 192kbps with 44.1kHz sample rate and major improvements on our side.
   * 'ultra' - ultra quality output format, 192kbps with 44.1kHz sample rate and highest improvements on our side.
   * 'ultra_lossless' - ultra quality output format, 705.6kbps with 44.1kHz sample rate and highest improvements on our side in a fully lossless format.
   * If not provided, defaults to the highest quality preset available on your subscription tier.
   *
   */
  #[JsonProperty('quality_preset')]
  public ?string $qualityPreset;

  /**
   * @var ?value-of<\ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostDurationScale>
   * Duration of the generated podcast. Must be one of:
   * short - produces podcasts shorter than 3 minutes.
   * default - produces podcasts roughly between 3-7 minutes.
   * long - produces podcasts longer than 7 minutes.
   *
   */
  #[JsonProperty('duration_scale')]
  public ?string $durationScale;

  /**
   * An optional language of the Studio project. Two-letter language code (ISO 639-1).
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * The intro text that will always be added to the beginning of the podcast.
   */
  #[JsonProperty('intro')]
  public ?string $intro;

  /**
   * The outro text that will always be added to the end of the podcast.
   */
  #[JsonProperty('outro')]
  public ?string $outro;

  /**
   * Additional instructions prompt for the podcast generation used to adjust the podcast's style and tone.
   */
  #[JsonProperty('instructions_prompt')]
  public ?string $instructionsPrompt;

  /**
   * @var string[]|null
   * A brief summary or highlights of the Studio project's content, providing key points or themes. This should be between 10 and 70 characters.
   */
  #[JsonProperty('highlights'), ArrayType(['string'])]
  public ?array $highlights;

  /**
   *
   *     A url that will be called by our service when the Studio project is converted. Request will contain a json blob containing the status of the conversion
   *     Messages:
   *     1. When project was converted successfully:
   *     {
   *       type: "project_conversion_status",
   *       event_timestamp: 1234567890,
   *       data: {
   *         request_id: "1234567890",
   *         project_id: "21m00Tcm4TlvDq8ikWAM",
   *         conversion_status: "success",
   *         project_snapshot_id: "22m00Tcm4TlvDq8ikMAT",
   *         error_details: None,
   *       }
   *     }
   *     2. When project conversion failed:
   *     {
   *       type: "project_conversion_status",
   *       event_timestamp: 1234567890,
   *       data: {
   *         request_id: "1234567890",
   *         project_id: "21m00Tcm4TlvDq8ikWAM",
   *         conversion_status: "error",
   *         project_snapshot_id: None,
   *         error_details: "Error details if conversion failed"
   *       }
   *     }
   *
   *     3. When chapter was converted successfully:
   *     {
   *       type: "chapter_conversion_status",
   *       event_timestamp: 1234567890,
   *       data: {
   *         request_id: "1234567890",
   *         project_id: "21m00Tcm4TlvDq8ikWAM",
   *         chapter_id: "22m00Tcm4TlvDq8ikMAT",
   *         conversion_status: "success",
   *         chapter_snapshot_id: "23m00Tcm4TlvDq8ikMAV",
   *         error_details: None,
   *       }
   *     }
   *     4. When chapter conversion failed:
   *     {
   *       type: "chapter_conversion_status",
   *       event_timestamp: 1234567890,
   *       data: {
   *         request_id: "1234567890",
   *         project_id: "21m00Tcm4TlvDq8ikWAM",
   *         chapter_id: "22m00Tcm4TlvDq8ikMAT",
   *         conversion_status: "error",
   *         chapter_snapshot_id: None,
   *         error_details: "Error details if conversion failed"
   *       }
   *     }
   *
   */
  #[JsonProperty('callback_url')]
  public ?string $callbackUrl;

  /**
   * @var ?value-of<\ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization>
   *
   *     This parameter controls text normalization with four modes: 'auto', 'on', 'apply_english' and 'off'.
   *     When set to 'auto', the system will automatically decide whether to apply text normalization
   *     (e.g., spelling out numbers). With 'on', text normalization will always be applied, while
   *     with 'off', it will be skipped. 'apply_english' is the same as 'on' but will assume that text is in English.
   *
   */
  #[JsonProperty('apply_text_normalization')]
  public ?string $applyTextNormalization;

  /**
   * @param array{
   *   modelId: string,
   *   mode: \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostMode,
   *   source: \ElevenLabs\Types\PodcastTextSource|\ElevenLabs\Types\PodcastUrlSource|array,
   *   safetyIdentifier?: ?string,
   *   qualityPreset?: ?value-of<\ElevenLabs\Types\QualityPresetType>,
   *   durationScale?: ?value-of<\ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostDurationScale>,
   *   language?: ?string,
   *   intro?: ?string,
   *   outro?: ?string,
   *   instructionsPrompt?: ?string,
   *   highlights?: string[]|null,
   *   callbackUrl?: ?string,
   *   applyTextNormalization?: ?value-of<\ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->safetyIdentifier = $values['safetyIdentifier'] ?? null;
    $this->modelId = $values['modelId'];
    $this->mode = $values['mode'];
    $this->source = $values['source'];
    $this->qualityPreset = $values['qualityPreset'] ?? null;
    $this->durationScale = $values['durationScale'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->intro = $values['intro'] ?? null;
    $this->outro = $values['outro'] ?? null;
    $this->instructionsPrompt = $values['instructionsPrompt'] ?? null;
    $this->highlights = $values['highlights'] ?? null;
    $this->callbackUrl = $values['callbackUrl'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;

    $this->_dirtyFields = [
      'model_id' => true,
      'mode' => true,
      'source' => true
    ];
    if (array_key_exists('qualityPreset', $values)) {
      $this->_dirtyFields['quality_preset'] = true;
    }
    if (array_key_exists('durationScale', $values)) {
      $this->_dirtyFields['duration_scale'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('intro', $values)) {
      $this->_dirtyFields['intro'] = true;
    }
    if (array_key_exists('outro', $values)) {
      $this->_dirtyFields['outro'] = true;
    }
    if (array_key_exists('instructionsPrompt', $values)) {
      $this->_dirtyFields['instructions_prompt'] = true;
    }
    if (array_key_exists('highlights', $values)) {
      $this->_dirtyFields['highlights'] = true;
    }
    if (array_key_exists('callbackUrl', $values)) {
      $this->_dirtyFields['callback_url'] = true;
    }
    if (array_key_exists('applyTextNormalization', $values)) {
      $this->_dirtyFields['apply_text_normalization'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    $parts[] = [
      'name' => 'mode',
      'contents' => json_encode($this->mode),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'source',
      'contents' => json_encode($this->source),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->qualityPreset !== null) {
      $parts[] = [
        'name' => 'quality_preset',
        'contents' => $this->qualityPreset
      ];
    }

    if ($this->durationScale !== null) {
      $parts[] = [
        'name' => 'duration_scale',
        'contents' => $this->durationScale
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->intro !== null) {
      $parts[] = [
        'name' => 'intro',
        'contents' => $this->intro
      ];
    }

    if ($this->outro !== null) {
      $parts[] = [
        'name' => 'outro',
        'contents' => $this->outro
      ];
    }

    if ($this->instructionsPrompt !== null) {
      $parts[] = [
        'name' => 'instructions_prompt',
        'contents' => $this->instructionsPrompt
      ];
    }

    if ($this->highlights !== null) {
      foreach ($this->highlights ?? [] as $item) {
        $parts[] = [
          'name' => 'highlights',
          'contents' => $item
        ];
      }
    }

    if ($this->callbackUrl !== null) {
      $parts[] = [
        'name' => 'callback_url',
        'contents' => $this->callbackUrl
      ];
    }

    if ($this->applyTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_text_normalization',
        'contents' => $this->applyTextNormalization
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->language, 'language', minLength: 2, maxLength: 2);
    Validator::validateString($this->intro, 'intro', maxLength: 1500);
    Validator::validateString($this->outro, 'outro', maxLength: 1500);
    Validator::validateString($this->instructionsPrompt, 'instructions_prompt', maxLength: 3000);
  }
}
