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
class ProjectResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * The name of the project.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The creation date of the project.
   */
  #[JsonProperty('create_date_unix', required: true)]
  public int $createDateUnix;

  /**
   * The user ID who created the project.
   */
  #[JsonProperty('created_by_user_id', required: true)]
  public ?string $createdByUserId;

  /**
   * The default title project voice reference ID.
   */
  #[JsonProperty('default_title_voice_ref_id', required: true)]
  public string $defaultTitleVoiceRefId;

  /**
   * The default paragraph project voice reference ID.
   */
  #[JsonProperty('default_paragraph_voice_ref_id', required: true)]
  public string $defaultParagraphVoiceRefId;

  /**
   * The default model ID.
   */
  #[JsonProperty('default_model_id', required: true)]
  public string $defaultModelId;

  /**
   * The last conversion date of the project.
   */
  #[JsonProperty('last_conversion_date_unix')]
  public ?int $lastConversionDateUnix;

  /**
   * Whether the project can be downloaded.
   */
  #[JsonProperty('can_be_downloaded', required: true)]
  public bool $canBeDownloaded;

  /**
   * The title of the project.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * The author of the project.
   */
  #[JsonProperty('author')]
  public ?string $author;

  /**
   * The description of the project.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * List of genres of the project.
   */
  #[JsonProperty('genres'), ArrayType(['string'])]
  public ?array $genres;

  /**
   * The cover image URL of the project.
   */
  #[JsonProperty('cover_image_url')]
  public ?string $coverImageUrl;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectResponseTargetAudience>
   * The target audience of the project.
   */
  #[JsonProperty('target_audience')]
  public ?string $targetAudience;

  /**
   * Two-letter language code (ISO 639-1) of the language of the project.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * The content type of the project, e.g. 'Novel' or 'Short Story'
   */
  #[JsonProperty('content_type')]
  public ?string $contentType;

  /**
   * The original publication date of the project.
   */
  #[JsonProperty('original_publication_date')]
  public ?string $originalPublicationDate;

  /**
   * Whether the project contains mature content.
   */
  #[JsonProperty('mature_content')]
  public ?bool $matureContent;

  /**
   * The ISBN number of the project.
   */
  #[JsonProperty('isbn_number')]
  public ?string $isbnNumber;

  /**
   * Whether the project uses volume normalization.
   */
  #[JsonProperty('volume_normalization', required: true)]
  public bool $volumeNormalization;

  /**
   * @var value-of<\ElevenLabs\Types\ProjectState>
   * The state of the project.
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * @var value-of<\ElevenLabs\Types\ProjectResponseAccessLevel>
   * The access level of the project.
   */
  #[JsonProperty('access_level', required: true)]
  public string $accessLevel;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectResponseFiction>
   * Whether the project is fiction.
   */
  #[JsonProperty('fiction')]
  public ?string $fiction;

  /**
   * Whether quality check is enabled for this project.
   */
  #[JsonProperty('quality_check_on', required: true)]
  public bool $qualityCheckOn;

  /**
   * Whether quality check is enabled on the project when bulk converting.
   */
  #[JsonProperty('quality_check_on_when_bulk_convert', required: true)]
  public bool $qualityCheckOnWhenBulkConvert;

  /**
   * The creation meta of the project.
   */
  #[JsonProperty('creation_meta')]
  public ?\ElevenLabs\Types\ProjectCreationMetaResponseModel $creationMeta;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectResponseSourceType>
   * The source type of the project.
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  /**
   * Whether chapters are enabled for the project.
   */
  #[JsonProperty('chapters_enabled')]
  public ?bool $chaptersEnabled;

  /**
   * Whether captions are enabled for the project.
   */
  #[JsonProperty('captions_enabled')]
  public ?bool $captionsEnabled;

  /**
   * Global styling to be applied to all captions
   */
  #[JsonProperty('caption_style')]
  public ?\ElevenLabs\Types\CaptionStyleModel $captionStyle;

  /**
   * @var array<string, \ElevenLabs\Types\CaptionStyleModel>|null
   * Styling changes that have been made to the provided templates
   */
  #[
    JsonProperty('caption_style_template_overrides'),
    ArrayType(['string' => \ElevenLabs\Types\CaptionStyleModel::class])
  ]
  public ?array $captionStyleTemplateOverrides;

  /**
   * The public share ID of the project.
   */
  #[JsonProperty('public_share_id')]
  public ?string $publicShareId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProjectResponseAspectRatio>
   * The aspect ratio of the project.
   */
  #[JsonProperty('aspect_ratio')]
  public ?string $aspectRatio;

  /**
   * Agent-related settings for the project
   */
  #[JsonProperty('agent_settings')]
  public ?\ElevenLabs\Types\StudioAgentSettingsModel $agentSettings;

  /**
   * The default title voice ID.
   */
  #[JsonProperty('default_title_voice_id')]
  public ?string $defaultTitleVoiceId;

  /**
   * The default paragraph voice ID.
   */
  #[JsonProperty('default_paragraph_voice_id')]
  public ?string $defaultParagraphVoiceId;

  /**
   * @param array{
   *   projectId: string,
   *   name: string,
   *   createDateUnix: int,
   *   createdByUserId: ?string,
   *   defaultTitleVoiceRefId: string,
   *   defaultParagraphVoiceRefId: string,
   *   defaultModelId: string,
   *   canBeDownloaded: bool,
   *   volumeNormalization: bool,
   *   state: value-of<\ElevenLabs\Types\ProjectState>,
   *   accessLevel: value-of<\ElevenLabs\Types\ProjectResponseAccessLevel>,
   *   qualityCheckOn: bool,
   *   qualityCheckOnWhenBulkConvert: bool,
   *   lastConversionDateUnix?: ?int,
   *   title?: ?string,
   *   author?: ?string,
   *   description?: ?string,
   *   genres?: string[]|null,
   *   coverImageUrl?: ?string,
   *   targetAudience?: ?value-of<\ElevenLabs\Types\ProjectResponseTargetAudience>,
   *   language?: ?string,
   *   contentType?: ?string,
   *   originalPublicationDate?: ?string,
   *   matureContent?: ?bool,
   *   isbnNumber?: ?string,
   *   fiction?: ?value-of<\ElevenLabs\Types\ProjectResponseFiction>,
   *   creationMeta?: ?\ElevenLabs\Types\ProjectCreationMetaResponseModel,
   *   sourceType?: ?value-of<\ElevenLabs\Types\ProjectResponseSourceType>,
   *   chaptersEnabled?: ?bool,
   *   captionsEnabled?: ?bool,
   *   captionStyle?: ?\ElevenLabs\Types\CaptionStyleModel,
   *   captionStyleTemplateOverrides?: array<string, \ElevenLabs\Types\CaptionStyleModel>|null,
   *   publicShareId?: ?string,
   *   aspectRatio?: ?value-of<\ElevenLabs\Types\ProjectResponseAspectRatio>,
   *   agentSettings?: ?\ElevenLabs\Types\StudioAgentSettingsModel,
   *   defaultTitleVoiceId?: ?string,
   *   defaultParagraphVoiceId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectId = $values['projectId'];
    $this->name = $values['name'];
    $this->createDateUnix = $values['createDateUnix'];
    $this->createdByUserId = $values['createdByUserId'];
    $this->defaultTitleVoiceRefId = $values['defaultTitleVoiceRefId'];
    $this->defaultParagraphVoiceRefId = $values['defaultParagraphVoiceRefId'];
    $this->defaultModelId = $values['defaultModelId'];
    $this->lastConversionDateUnix = $values['lastConversionDateUnix'] ?? null;
    $this->canBeDownloaded = $values['canBeDownloaded'];
    $this->title = $values['title'] ?? null;
    $this->author = $values['author'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->genres = $values['genres'] ?? null;
    $this->coverImageUrl = $values['coverImageUrl'] ?? null;
    $this->targetAudience = $values['targetAudience'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->contentType = $values['contentType'] ?? null;
    $this->originalPublicationDate = $values['originalPublicationDate'] ?? null;
    $this->matureContent = $values['matureContent'] ?? null;
    $this->isbnNumber = $values['isbnNumber'] ?? null;
    $this->volumeNormalization = $values['volumeNormalization'];
    $this->state = $values['state'];
    $this->accessLevel = $values['accessLevel'];
    $this->fiction = $values['fiction'] ?? null;
    $this->qualityCheckOn = $values['qualityCheckOn'];
    $this->qualityCheckOnWhenBulkConvert = $values['qualityCheckOnWhenBulkConvert'];
    $this->creationMeta = $values['creationMeta'] ?? null;
    $this->sourceType = $values['sourceType'] ?? null;
    $this->chaptersEnabled = $values['chaptersEnabled'] ?? null;
    $this->captionsEnabled = $values['captionsEnabled'] ?? null;
    $this->captionStyle = $values['captionStyle'] ?? null;
    $this->captionStyleTemplateOverrides = $values['captionStyleTemplateOverrides'] ?? null;
    $this->publicShareId = $values['publicShareId'] ?? null;
    $this->aspectRatio = $values['aspectRatio'] ?? null;
    $this->agentSettings = $values['agentSettings'] ?? null;
    $this->defaultTitleVoiceId = $values['defaultTitleVoiceId'] ?? null;
    $this->defaultParagraphVoiceId = $values['defaultParagraphVoiceId'] ?? null;

    $this->_dirtyFields = [
      'project_id' => true,
      'name' => true,
      'create_date_unix' => true,
      'created_by_user_id' => true,
      'default_title_voice_ref_id' => true,
      'default_paragraph_voice_ref_id' => true,
      'default_model_id' => true,
      'can_be_downloaded' => true,
      'volume_normalization' => true,
      'state' => true,
      'access_level' => true,
      'quality_check_on' => true,
      'quality_check_on_when_bulk_convert' => true
    ];
    if (array_key_exists('lastConversionDateUnix', $values)) {
      $this->_dirtyFields['last_conversion_date_unix'] = true;
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
    if (array_key_exists('coverImageUrl', $values)) {
      $this->_dirtyFields['cover_image_url'] = true;
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
    if (array_key_exists('fiction', $values)) {
      $this->_dirtyFields['fiction'] = true;
    }
    if (array_key_exists('creationMeta', $values)) {
      $this->_dirtyFields['creation_meta'] = true;
    }
    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('chaptersEnabled', $values)) {
      $this->_dirtyFields['chapters_enabled'] = true;
    }
    if (array_key_exists('captionsEnabled', $values)) {
      $this->_dirtyFields['captions_enabled'] = true;
    }
    if (array_key_exists('captionStyle', $values)) {
      $this->_dirtyFields['caption_style'] = true;
    }
    if (array_key_exists('captionStyleTemplateOverrides', $values)) {
      $this->_dirtyFields['caption_style_template_overrides'] = true;
    }
    if (array_key_exists('publicShareId', $values)) {
      $this->_dirtyFields['public_share_id'] = true;
    }
    if (array_key_exists('aspectRatio', $values)) {
      $this->_dirtyFields['aspect_ratio'] = true;
    }
    if (array_key_exists('agentSettings', $values)) {
      $this->_dirtyFields['agent_settings'] = true;
    }
    if (array_key_exists('defaultTitleVoiceId', $values)) {
      $this->_dirtyFields['default_title_voice_id'] = true;
    }
    if (array_key_exists('defaultParagraphVoiceId', $values)) {
      $this->_dirtyFields['default_paragraph_voice_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'create_date_unix',
      'contents' => (string) $this->createDateUnix
    ];

    $parts[] = [
      'name' => 'created_by_user_id',
      'contents' => $this->createdByUserId
    ];

    $parts[] = [
      'name' => 'default_title_voice_ref_id',
      'contents' => $this->defaultTitleVoiceRefId
    ];

    $parts[] = [
      'name' => 'default_paragraph_voice_ref_id',
      'contents' => $this->defaultParagraphVoiceRefId
    ];

    $parts[] = [
      'name' => 'default_model_id',
      'contents' => $this->defaultModelId
    ];

    if ($this->lastConversionDateUnix !== null) {
      $parts[] = [
        'name' => 'last_conversion_date_unix',
        'contents' => (string) $this->lastConversionDateUnix
      ];
    }

    $parts[] = [
      'name' => 'can_be_downloaded',
      'contents' => $this->canBeDownloaded ? 'true' : 'false'
    ];

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

    if ($this->coverImageUrl !== null) {
      $parts[] = [
        'name' => 'cover_image_url',
        'contents' => $this->coverImageUrl
      ];
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

    $parts[] = [
      'name' => 'volume_normalization',
      'contents' => $this->volumeNormalization ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    $parts[] = [
      'name' => 'access_level',
      'contents' => $this->accessLevel
    ];

    if ($this->fiction !== null) {
      $parts[] = [
        'name' => 'fiction',
        'contents' => $this->fiction
      ];
    }

    $parts[] = [
      'name' => 'quality_check_on',
      'contents' => $this->qualityCheckOn ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'quality_check_on_when_bulk_convert',
      'contents' => $this->qualityCheckOnWhenBulkConvert ? 'true' : 'false'
    ];

    if ($this->creationMeta !== null) {
      $parts[] = [
        'name' => 'creation_meta',
        'contents' => json_encode($this->creationMeta),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    if ($this->chaptersEnabled !== null) {
      $parts[] = [
        'name' => 'chapters_enabled',
        'contents' => $this->chaptersEnabled ? 'true' : 'false'
      ];
    }

    if ($this->captionsEnabled !== null) {
      $parts[] = [
        'name' => 'captions_enabled',
        'contents' => $this->captionsEnabled ? 'true' : 'false'
      ];
    }

    if ($this->captionStyle !== null) {
      $parts[] = [
        'name' => 'caption_style',
        'contents' => json_encode($this->captionStyle),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->captionStyleTemplateOverrides !== null) {
      $parts[] = [
        'name' => 'caption_style_template_overrides',
        'contents' => json_encode($this->captionStyleTemplateOverrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->publicShareId !== null) {
      $parts[] = [
        'name' => 'public_share_id',
        'contents' => $this->publicShareId
      ];
    }

    if ($this->aspectRatio !== null) {
      $parts[] = [
        'name' => 'aspect_ratio',
        'contents' => $this->aspectRatio
      ];
    }

    if ($this->agentSettings !== null) {
      $parts[] = [
        'name' => 'agent_settings',
        'contents' => json_encode($this->agentSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    return $parts;
  }

  public function validate(): void
  {
    $this->creationMeta?->validate();
    $this->captionStyle?->validate();
    $this->agentSettings?->validate();
  }
}
