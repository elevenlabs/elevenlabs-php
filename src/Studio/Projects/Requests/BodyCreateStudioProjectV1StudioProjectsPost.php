<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Requests;

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
class BodyCreateStudioProjectV1StudioProjectsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the Studio project, used for identification only.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The voice_id that corresponds to the default voice used for new titles.
   */
  #[JsonProperty('default_title_voice_id')]
  public ?string $defaultTitleVoiceId;

  /**
   * The voice_id that corresponds to the default voice used for new paragraphs.
   */
  #[JsonProperty('default_paragraph_voice_id')]
  public ?string $defaultParagraphVoiceId;

  /**
   * The ID of the model to be used for this Studio project, you can query GET /v1/models to list all available models.
   */
  #[JsonProperty('default_model_id')]
  public ?string $defaultModelId;

  /**
   * An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   */
  #[JsonProperty('from_url')]
  public ?string $fromUrl;

  /**
   * @var ?\ElevenLabs\Utils\File
   * An optional .epub, .pdf, .txt or similar file can be provided. If provided, we will initialize the Studio project with its content. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   */
  #[JsonProperty('from_document')]
  public ?\ElevenLabs\Utils\File $fromDocument;

  /**
   *
   *     An optional content to initialize the Studio project with. If this is set, 'from_url' and 'from_document' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   *
   *     Example:
   *     [{"name": "Chapter A", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "A", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "B", "type": "tts_node"}]}, {"sub_type": "h1", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "C", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "D", "type": "tts_node"}]}]}, {"name": "Chapter B", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "E", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "F", "type": "tts_node"}]}, {"sub_type": "h2", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "G", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "H", "type": "tts_node"}]}]}]
   *
   */
  #[JsonProperty('from_content_json')]
  public ?string $fromContentJson;

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
   * An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('author')]
  public ?string $author;

  /**
   * An optional description of the Studio project.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * An optional list of genres associated with the Studio project.
   */
  #[JsonProperty('genres'), ArrayType(['string'])]
  public ?array $genres;

  /**
   * @var ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestTargetAudience>
   * An optional target audience of the Studio project.
   */
  #[JsonProperty('target_audience')]
  public ?string $targetAudience;

  /**
   * An optional language of the Studio project. Two-letter language code (ISO 639-1).
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * An optional content type of the Studio project.
   */
  #[JsonProperty('content_type')]
  public ?string $contentType;

  /**
   * An optional original publication date of the Studio project, in the format YYYY-MM-DD or YYYY.
   */
  #[JsonProperty('original_publication_date')]
  public ?string $originalPublicationDate;

  /**
   * An optional specification of whether this Studio project contains mature content.
   */
  #[JsonProperty('mature_content')]
  public ?bool $matureContent;

  /**
   * An optional ISBN number of the Studio project you want to create, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('isbn_number')]
  public ?string $isbnNumber;

  /**
   * [Deprecated] When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
   */
  #[JsonProperty('acx_volume_normalization')]
  public ?bool $acxVolumeNormalization;

  /**
   * When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
   */
  #[JsonProperty('volume_normalization')]
  public ?bool $volumeNormalization;

  /**
   * @var string[]|null
   * A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
   */
  #[JsonProperty('pronunciation_dictionary_locators'), ArrayType(['string'])]
  public ?array $pronunciationDictionaryLocators;

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
   * @var ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestFiction>
   * An optional specification of whether the content of this Studio project is fiction.
   */
  #[JsonProperty('fiction')]
  public ?string $fiction;

  /**
   * @var ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestApplyTextNormalization>
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
   * Whether to auto convert the Studio project to audio or not.
   */
  #[JsonProperty('auto_convert')]
  public ?bool $autoConvert;

  /**
   * [Alpha Feature] Whether automatically assign voices to phrases in the create Project.
   */
  #[JsonProperty('auto_assign_voices')]
  public ?bool $autoAssignVoices;

  /**
   * @var ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestSourceType>
   * The type of Studio project to create.
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  /**
   * @var string[]|null
   *     Optional voice settings overrides for the project, encoded as a list of JSON strings.
   *
   *     Example:
   *     ["{\"voice_id\": \"21m00Tcm4TlvDq8ikWAM\", \"stability\": 0.7, \"similarity_boost\": 0.8, \"style\": 0.5, \"speed\": 1.0, \"use_speaker_boost\": true}"]
   *
   */
  #[JsonProperty('voice_settings'), ArrayType(['string'])]
  public ?array $voiceSettings;

  /**
   * If true, creates a corresponding read for direct publishing in draft state
   */
  #[JsonProperty('create_publishing_read')]
  public ?bool $createPublishingRead;

  /**
   * @param array{
   *   name: string,
   *   defaultTitleVoiceId?: ?string,
   *   defaultParagraphVoiceId?: ?string,
   *   defaultModelId?: ?string,
   *   fromUrl?: ?string,
   *   fromDocument?: ?\ElevenLabs\Utils\File,
   *   fromContentJson?: ?string,
   *   qualityPreset?: ?value-of<\ElevenLabs\Types\QualityPresetType>,
   *   title?: ?string,
   *   author?: ?string,
   *   description?: ?string,
   *   genres?: string[]|null,
   *   targetAudience?: ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestTargetAudience>,
   *   language?: ?string,
   *   contentType?: ?string,
   *   originalPublicationDate?: ?string,
   *   matureContent?: ?bool,
   *   isbnNumber?: ?string,
   *   acxVolumeNormalization?: ?bool,
   *   volumeNormalization?: ?bool,
   *   pronunciationDictionaryLocators?: string[]|null,
   *   callbackUrl?: ?string,
   *   fiction?: ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestFiction>,
   *   applyTextNormalization?: ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestApplyTextNormalization>,
   *   autoConvert?: ?bool,
   *   autoAssignVoices?: ?bool,
   *   sourceType?: ?value-of<\ElevenLabs\Studio\Projects\Types\CreateProjectsRequestSourceType>,
   *   voiceSettings?: string[]|null,
   *   createPublishingRead?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->defaultTitleVoiceId = $values['defaultTitleVoiceId'] ?? null;
    $this->defaultParagraphVoiceId = $values['defaultParagraphVoiceId'] ?? null;
    $this->defaultModelId = $values['defaultModelId'] ?? null;
    $this->fromUrl = $values['fromUrl'] ?? null;
    $this->fromDocument = $values['fromDocument'] ?? null;
    $this->fromContentJson = $values['fromContentJson'] ?? null;
    $this->qualityPreset = $values['qualityPreset'] ?? null;
    $this->title = $values['title'] ?? null;
    $this->author = $values['author'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->genres = $values['genres'] ?? null;
    $this->targetAudience = $values['targetAudience'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->contentType = $values['contentType'] ?? null;
    $this->originalPublicationDate = $values['originalPublicationDate'] ?? null;
    $this->matureContent = $values['matureContent'] ?? null;
    $this->isbnNumber = $values['isbnNumber'] ?? null;
    $this->acxVolumeNormalization = $values['acxVolumeNormalization'] ?? null;
    $this->volumeNormalization = $values['volumeNormalization'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;
    $this->callbackUrl = $values['callbackUrl'] ?? null;
    $this->fiction = $values['fiction'] ?? null;
    $this->applyTextNormalization = $values['applyTextNormalization'] ?? null;
    $this->autoConvert = $values['autoConvert'] ?? null;
    $this->autoAssignVoices = $values['autoAssignVoices'] ?? null;
    $this->sourceType = $values['sourceType'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->createPublishingRead = $values['createPublishingRead'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('defaultTitleVoiceId', $values)) {
      $this->_dirtyFields['default_title_voice_id'] = true;
    }
    if (array_key_exists('defaultParagraphVoiceId', $values)) {
      $this->_dirtyFields['default_paragraph_voice_id'] = true;
    }
    if (array_key_exists('defaultModelId', $values)) {
      $this->_dirtyFields['default_model_id'] = true;
    }
    if (array_key_exists('fromUrl', $values)) {
      $this->_dirtyFields['from_url'] = true;
    }
    if (array_key_exists('fromDocument', $values)) {
      $this->_dirtyFields['from_document'] = true;
    }
    if (array_key_exists('fromContentJson', $values)) {
      $this->_dirtyFields['from_content_json'] = true;
    }
    if (array_key_exists('qualityPreset', $values)) {
      $this->_dirtyFields['quality_preset'] = true;
    }
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('author', $values)) {
      $this->_dirtyFields['author'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('genres', $values)) {
      $this->_dirtyFields['genres'] = true;
    }
    if (array_key_exists('targetAudience', $values)) {
      $this->_dirtyFields['target_audience'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('originalPublicationDate', $values)) {
      $this->_dirtyFields['original_publication_date'] = true;
    }
    if (array_key_exists('matureContent', $values)) {
      $this->_dirtyFields['mature_content'] = true;
    }
    if (array_key_exists('isbnNumber', $values)) {
      $this->_dirtyFields['isbn_number'] = true;
    }
    if (array_key_exists('acxVolumeNormalization', $values)) {
      $this->_dirtyFields['acx_volume_normalization'] = true;
    }
    if (array_key_exists('volumeNormalization', $values)) {
      $this->_dirtyFields['volume_normalization'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
    if (array_key_exists('callbackUrl', $values)) {
      $this->_dirtyFields['callback_url'] = true;
    }
    if (array_key_exists('fiction', $values)) {
      $this->_dirtyFields['fiction'] = true;
    }
    if (array_key_exists('applyTextNormalization', $values)) {
      $this->_dirtyFields['apply_text_normalization'] = true;
    }
    if (array_key_exists('autoConvert', $values)) {
      $this->_dirtyFields['auto_convert'] = true;
    }
    if (array_key_exists('autoAssignVoices', $values)) {
      $this->_dirtyFields['auto_assign_voices'] = true;
    }
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('createPublishingRead', $values)) {
      $this->_dirtyFields['create_publishing_read'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->defaultTitleVoiceId !== null) {
      $parts[] = [
        'name' => 'default_title_voice_id',
        'contents' => $this->defaultTitleVoiceId
      ];
    }

    if ($this->defaultParagraphVoiceId !== null) {
      $parts[] = [
        'name' => 'default_paragraph_voice_id',
        'contents' => $this->defaultParagraphVoiceId
      ];
    }

    if ($this->defaultModelId !== null) {
      $parts[] = [
        'name' => 'default_model_id',
        'contents' => $this->defaultModelId
      ];
    }

    if ($this->fromUrl !== null) {
      $parts[] = [
        'name' => 'from_url',
        'contents' => $this->fromUrl
      ];
    }

    if ($this->fromDocument !== null) {
      $parts[] = $this->fromDocument->toMultipartFormDataPart('from_document')->toGuzzlePart();
    }

    if ($this->fromContentJson !== null) {
      $parts[] = [
        'name' => 'from_content_json',
        'contents' => $this->fromContentJson
      ];
    }

    if ($this->qualityPreset !== null) {
      $parts[] = [
        'name' => 'quality_preset',
        'contents' => $this->qualityPreset
      ];
    }

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->author !== null) {
      $parts[] = [
        'name' => 'author',
        'contents' => $this->author
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->genres !== null) {
      foreach ($this->genres ?? [] as $item) {
        $parts[] = [
          'name' => 'genres',
          'contents' => $item
        ];
      }
    }

    if ($this->targetAudience !== null) {
      $parts[] = [
        'name' => 'target_audience',
        'contents' => $this->targetAudience
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    if ($this->originalPublicationDate !== null) {
      $parts[] = [
        'name' => 'original_publication_date',
        'contents' => $this->originalPublicationDate
      ];
    }

    if ($this->matureContent !== null) {
      $parts[] = [
        'name' => 'mature_content',
        'contents' => $this->matureContent ? 'true' : 'false'
      ];
    }

    if ($this->isbnNumber !== null) {
      $parts[] = [
        'name' => 'isbn_number',
        'contents' => $this->isbnNumber
      ];
    }

    if ($this->acxVolumeNormalization !== null) {
      $parts[] = [
        'name' => 'acx_volume_normalization',
        'contents' => $this->acxVolumeNormalization ? 'true' : 'false'
      ];
    }

    if ($this->volumeNormalization !== null) {
      $parts[] = [
        'name' => 'volume_normalization',
        'contents' => $this->volumeNormalization ? 'true' : 'false'
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
        $parts[] = [
          'name' => 'pronunciation_dictionary_locators',
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

    if ($this->fiction !== null) {
      $parts[] = [
        'name' => 'fiction',
        'contents' => $this->fiction
      ];
    }

    if ($this->applyTextNormalization !== null) {
      $parts[] = [
        'name' => 'apply_text_normalization',
        'contents' => $this->applyTextNormalization
      ];
    }

    if ($this->autoConvert !== null) {
      $parts[] = [
        'name' => 'auto_convert',
        'contents' => $this->autoConvert ? 'true' : 'false'
      ];
    }

    if ($this->autoAssignVoices !== null) {
      $parts[] = [
        'name' => 'auto_assign_voices',
        'contents' => $this->autoAssignVoices ? 'true' : 'false'
      ];
    }

    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    if ($this->voiceSettings !== null) {
      foreach ($this->voiceSettings ?? [] as $item) {
        $parts[] = [
          'name' => 'voice_settings',
          'contents' => $item
        ];
      }
    }

    if ($this->createPublishingRead !== null) {
      $parts[] = [
        'name' => 'create_publishing_read',
        'contents' => $this->createPublishingRead ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->language, 'language', minLength: 2, maxLength: 2);
    Validator::validateString(
      $this->originalPublicationDate,
      'original_publication_date',
      pattern: '^\\d{4}-\\d{2}-\\d{2}$|^\\d{4}$'
    );
  }
}
