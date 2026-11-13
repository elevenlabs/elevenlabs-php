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
class DirectPublishingReadResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('read_id', required: true)]
  public string $readId;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  #[JsonProperty('word_count', required: true)]
  public int $wordCount;

  #[JsonProperty('char_count', required: true)]
  public int $charCount;

  /**
   * @var \ElevenLabs\Types\ReadMetadataChapterDbModel[]
   */
  #[
    JsonProperty('chapters', required: true),
    ArrayType([\ElevenLabs\Types\ReadMetadataChapterDbModel::class])
  ]
  public array $chapters;

  #[JsonProperty('title')]
  public ?string $title;

  #[JsonProperty('author')]
  public ?string $author;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('article_image_url')]
  public ?string $articleImageUrl;

  #[JsonProperty('language')]
  public ?string $language;

  #[JsonProperty('locale')]
  public ?string $locale;

  /**
   * @var ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelDisplayMode>
   */
  #[JsonProperty('display_mode')]
  public ?string $displayMode;

  /**
   * @var array<value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelGenreItem>>|null
   */
  #[JsonProperty('genre'), ArrayType(['string'])]
  public ?array $genre;

  #[JsonProperty('fiction')]
  public ?string $fiction;

  #[JsonProperty('content_type')]
  public ?string $contentType;

  #[JsonProperty('original_file_type')]
  public ?string $originalFileType;

  /**
   * @var ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelTargetAudience>
   */
  #[JsonProperty('target_audience')]
  public ?string $targetAudience;

  #[JsonProperty('mature_content')]
  public ?bool $matureContent;

  #[JsonProperty('safesearch_adult')]
  public ?bool $safesearchAdult;

  #[JsonProperty('origin')]
  public ?string $origin;

  #[JsonProperty('publication_date')]
  public ?string $publicationDate;

  #[JsonProperty('isbn')]
  public ?string $isbn;

  #[JsonProperty('ean')]
  public ?string $ean;

  #[JsonProperty('legal_terms')]
  public ?\ElevenLabs\Types\ReadLegalTerms $legalTerms;

  #[JsonProperty('content_guidelines_terms')]
  public ?\ElevenLabs\Types\ReadLegalTerms $contentGuidelinesTerms;

  #[JsonProperty('last_updated_from_project_unix')]
  public ?int $lastUpdatedFromProjectUnix;

  #[JsonProperty('publishing_project_id')]
  public ?string $publishingProjectId;

  #[JsonProperty('publishing_state')]
  public ?string $publishingState;

  #[JsonProperty('publisher_profile_id')]
  public ?string $publisherProfileId;

  #[JsonProperty('quality_score')]
  public ?int $qualityScore;

  #[JsonProperty('publisher')]
  public ?string $publisher;

  #[JsonProperty('copyright')]
  public ?string $copyright;

  #[JsonProperty('subtitle')]
  public ?string $subtitle;

  /**
   * @var string[]|null
   */
  #[JsonProperty('distribution_territories'), ArrayType(['string'])]
  public ?array $distributionTerritories;

  #[JsonProperty('edition')]
  public ?string $edition;

  /**
   * @var \ElevenLabs\Types\Contributor[]|null
   */
  #[JsonProperty('contributors'), ArrayType([\ElevenLabs\Types\Contributor::class])]
  public ?array $contributors;

  /**
   * @var ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelPayoutType>
   */
  #[JsonProperty('payout_type')]
  public ?string $payoutType;

  #[JsonProperty('list_price')]
  public ?float $listPrice;

  /**
   * @var ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelCurrency>
   */
  #[JsonProperty('currency')]
  public ?string $currency;

  #[JsonProperty('original_audio_project_export_id')]
  public ?string $originalAudioProjectExportId;

  #[JsonProperty('original_audio_document_id')]
  public ?string $originalAudioDocumentId;

  #[JsonProperty('series_id')]
  public ?string $seriesId;

  #[JsonProperty('volume')]
  public ?int $volume;

  #[JsonProperty('published_at_unix')]
  public ?int $publishedAtUnix;

  #[JsonProperty('read_slug')]
  public ?string $readSlug;

  #[JsonProperty('preview_audio_object')]
  public ?\ElevenLabs\Types\PreviewAudioDbModel $previewAudioObject;

  #[JsonProperty('sample_config')]
  public ?\ElevenLabs\Types\SampleConfigDbModel $sampleConfig;

  #[JsonProperty('review')]
  public ?\ElevenLabs\Types\ReviewResponseModel $review;

  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  #[JsonProperty('can_use_assistant')]
  public ?bool $canUseAssistant;

  #[JsonProperty('is_voice_changer_on')]
  public ?bool $isVoiceChangerOn;

  /**
   * @var string[]|null
   */
  #[JsonProperty('restricted_to_user_email_domains'), ArrayType(['string'])]
  public ?array $restrictedToUserEmailDomains;

  /**
   * @param array{
   *   readId: string,
   *   createdAtUnix: int,
   *   updatedAtUnix: int,
   *   wordCount: int,
   *   charCount: int,
   *   chapters: \ElevenLabs\Types\ReadMetadataChapterDbModel[],
   *   title?: ?string,
   *   author?: ?string,
   *   description?: ?string,
   *   articleImageUrl?: ?string,
   *   language?: ?string,
   *   locale?: ?string,
   *   displayMode?: ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelDisplayMode>,
   *   genre?: array<value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelGenreItem>>|null,
   *   fiction?: ?string,
   *   contentType?: ?string,
   *   originalFileType?: ?string,
   *   targetAudience?: ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelTargetAudience>,
   *   matureContent?: ?bool,
   *   safesearchAdult?: ?bool,
   *   origin?: ?string,
   *   publicationDate?: ?string,
   *   isbn?: ?string,
   *   ean?: ?string,
   *   legalTerms?: ?\ElevenLabs\Types\ReadLegalTerms,
   *   contentGuidelinesTerms?: ?\ElevenLabs\Types\ReadLegalTerms,
   *   lastUpdatedFromProjectUnix?: ?int,
   *   publishingProjectId?: ?string,
   *   publishingState?: ?string,
   *   publisherProfileId?: ?string,
   *   qualityScore?: ?int,
   *   publisher?: ?string,
   *   copyright?: ?string,
   *   subtitle?: ?string,
   *   distributionTerritories?: string[]|null,
   *   edition?: ?string,
   *   contributors?: \ElevenLabs\Types\Contributor[]|null,
   *   payoutType?: ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelPayoutType>,
   *   listPrice?: ?float,
   *   currency?: ?value-of<\ElevenLabs\Types\DirectPublishingReadResponseModelCurrency>,
   *   originalAudioProjectExportId?: ?string,
   *   originalAudioDocumentId?: ?string,
   *   seriesId?: ?string,
   *   volume?: ?int,
   *   publishedAtUnix?: ?int,
   *   readSlug?: ?string,
   *   previewAudioObject?: ?\ElevenLabs\Types\PreviewAudioDbModel,
   *   sampleConfig?: ?\ElevenLabs\Types\SampleConfigDbModel,
   *   review?: ?\ElevenLabs\Types\ReviewResponseModel,
   *   voiceId?: ?string,
   *   canUseAssistant?: ?bool,
   *   isVoiceChangerOn?: ?bool,
   *   restrictedToUserEmailDomains?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->readId = $values['readId'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];
    $this->wordCount = $values['wordCount'];
    $this->charCount = $values['charCount'];
    $this->chapters = $values['chapters'];
    $this->title = $values['title'] ?? null;
    $this->author = $values['author'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->articleImageUrl = $values['articleImageUrl'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->locale = $values['locale'] ?? null;
    $this->displayMode = $values['displayMode'] ?? null;
    $this->genre = $values['genre'] ?? null;
    $this->fiction = $values['fiction'] ?? null;
    $this->contentType = $values['contentType'] ?? null;
    $this->originalFileType = $values['originalFileType'] ?? null;
    $this->targetAudience = $values['targetAudience'] ?? null;
    $this->matureContent = $values['matureContent'] ?? null;
    $this->safesearchAdult = $values['safesearchAdult'] ?? null;
    $this->origin = $values['origin'] ?? null;
    $this->publicationDate = $values['publicationDate'] ?? null;
    $this->isbn = $values['isbn'] ?? null;
    $this->ean = $values['ean'] ?? null;
    $this->legalTerms = $values['legalTerms'] ?? null;
    $this->contentGuidelinesTerms = $values['contentGuidelinesTerms'] ?? null;
    $this->lastUpdatedFromProjectUnix = $values['lastUpdatedFromProjectUnix'] ?? null;
    $this->publishingProjectId = $values['publishingProjectId'] ?? null;
    $this->publishingState = $values['publishingState'] ?? null;
    $this->publisherProfileId = $values['publisherProfileId'] ?? null;
    $this->qualityScore = $values['qualityScore'] ?? null;
    $this->publisher = $values['publisher'] ?? null;
    $this->copyright = $values['copyright'] ?? null;
    $this->subtitle = $values['subtitle'] ?? null;
    $this->distributionTerritories = $values['distributionTerritories'] ?? null;
    $this->edition = $values['edition'] ?? null;
    $this->contributors = $values['contributors'] ?? null;
    $this->payoutType = $values['payoutType'] ?? null;
    $this->listPrice = $values['listPrice'] ?? null;
    $this->currency = $values['currency'] ?? 'usd';
    $this->originalAudioProjectExportId = $values['originalAudioProjectExportId'] ?? null;
    $this->originalAudioDocumentId = $values['originalAudioDocumentId'] ?? null;
    $this->seriesId = $values['seriesId'] ?? null;
    $this->volume = $values['volume'] ?? null;
    $this->publishedAtUnix = $values['publishedAtUnix'] ?? null;
    $this->readSlug = $values['readSlug'] ?? null;
    $this->previewAudioObject = $values['previewAudioObject'] ?? null;
    $this->sampleConfig = $values['sampleConfig'] ?? null;
    $this->review = $values['review'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->canUseAssistant = $values['canUseAssistant'] ?? null;
    $this->isVoiceChangerOn = $values['isVoiceChangerOn'] ?? null;
    $this->restrictedToUserEmailDomains = $values['restrictedToUserEmailDomains'] ?? null;

    $this->_dirtyFields = [
      'read_id' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true,
      'word_count' => true,
      'char_count' => true,
      'chapters' => true
    ];
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('author', $values)) {
      $this->_dirtyFields['author'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('articleImageUrl', $values)) {
      $this->_dirtyFields['article_image_url'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('locale', $values)) {
      $this->_dirtyFields['locale'] = true;
    }
    if (array_key_exists('displayMode', $values)) {
      $this->_dirtyFields['display_mode'] = true;
    }
    if (array_key_exists('genre', $values)) {
      $this->_dirtyFields['genre'] = true;
    }
    if (array_key_exists('fiction', $values)) {
      $this->_dirtyFields['fiction'] = true;
    }
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('originalFileType', $values)) {
      $this->_dirtyFields['original_file_type'] = true;
    }
    if (array_key_exists('targetAudience', $values)) {
      $this->_dirtyFields['target_audience'] = true;
    }
    if (array_key_exists('matureContent', $values)) {
      $this->_dirtyFields['mature_content'] = true;
    }
    if (array_key_exists('safesearchAdult', $values)) {
      $this->_dirtyFields['safesearch_adult'] = true;
    }
    if (array_key_exists('origin', $values)) {
      $this->_dirtyFields['origin'] = true;
    }
    if (array_key_exists('publicationDate', $values)) {
      $this->_dirtyFields['publication_date'] = true;
    }
    if (array_key_exists('isbn', $values)) {
      $this->_dirtyFields['isbn'] = true;
    }
    if (array_key_exists('ean', $values)) {
      $this->_dirtyFields['ean'] = true;
    }
    if (array_key_exists('legalTerms', $values)) {
      $this->_dirtyFields['legal_terms'] = true;
    }
    if (array_key_exists('contentGuidelinesTerms', $values)) {
      $this->_dirtyFields['content_guidelines_terms'] = true;
    }
    if (array_key_exists('lastUpdatedFromProjectUnix', $values)) {
      $this->_dirtyFields['last_updated_from_project_unix'] = true;
    }
    if (array_key_exists('publishingProjectId', $values)) {
      $this->_dirtyFields['publishing_project_id'] = true;
    }
    if (array_key_exists('publishingState', $values)) {
      $this->_dirtyFields['publishing_state'] = true;
    }
    if (array_key_exists('publisherProfileId', $values)) {
      $this->_dirtyFields['publisher_profile_id'] = true;
    }
    if (array_key_exists('qualityScore', $values)) {
      $this->_dirtyFields['quality_score'] = true;
    }
    if (array_key_exists('publisher', $values)) {
      $this->_dirtyFields['publisher'] = true;
    }
    if (array_key_exists('copyright', $values)) {
      $this->_dirtyFields['copyright'] = true;
    }
    if (array_key_exists('subtitle', $values)) {
      $this->_dirtyFields['subtitle'] = true;
    }
    if (array_key_exists('distributionTerritories', $values)) {
      $this->_dirtyFields['distribution_territories'] = true;
    }
    if (array_key_exists('edition', $values)) {
      $this->_dirtyFields['edition'] = true;
    }
    if (array_key_exists('contributors', $values)) {
      $this->_dirtyFields['contributors'] = true;
    }
    if (array_key_exists('payoutType', $values)) {
      $this->_dirtyFields['payout_type'] = true;
    }
    if (array_key_exists('listPrice', $values)) {
      $this->_dirtyFields['list_price'] = true;
    }
    if (array_key_exists('currency', $values)) {
      $this->_dirtyFields['currency'] = true;
    }
    if (array_key_exists('originalAudioProjectExportId', $values)) {
      $this->_dirtyFields['original_audio_project_export_id'] = true;
    }
    if (array_key_exists('originalAudioDocumentId', $values)) {
      $this->_dirtyFields['original_audio_document_id'] = true;
    }
    if (array_key_exists('seriesId', $values)) {
      $this->_dirtyFields['series_id'] = true;
    }
    if (array_key_exists('volume', $values)) {
      $this->_dirtyFields['volume'] = true;
    }
    if (array_key_exists('publishedAtUnix', $values)) {
      $this->_dirtyFields['published_at_unix'] = true;
    }
    if (array_key_exists('readSlug', $values)) {
      $this->_dirtyFields['read_slug'] = true;
    }
    if (array_key_exists('previewAudioObject', $values)) {
      $this->_dirtyFields['preview_audio_object'] = true;
    }
    if (array_key_exists('sampleConfig', $values)) {
      $this->_dirtyFields['sample_config'] = true;
    }
    if (array_key_exists('review', $values)) {
      $this->_dirtyFields['review'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
    }
    if (array_key_exists('canUseAssistant', $values)) {
      $this->_dirtyFields['can_use_assistant'] = true;
    }
    if (array_key_exists('isVoiceChangerOn', $values)) {
      $this->_dirtyFields['is_voice_changer_on'] = true;
    }
    if (array_key_exists('restrictedToUserEmailDomains', $values)) {
      $this->_dirtyFields['restricted_to_user_email_domains'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'read_id',
      'contents' => $this->readId
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    $parts[] = [
      'name' => 'word_count',
      'contents' => (string) $this->wordCount
    ];

    $parts[] = [
      'name' => 'char_count',
      'contents' => (string) $this->charCount
    ];

    $parts[] = [
      'name' => 'chapters',
      'contents' => json_encode($this->chapters),
      'headers' => ['Content-Type' => 'application/json']
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

    if ($this->articleImageUrl !== null) {
      $parts[] = [
        'name' => 'article_image_url',
        'contents' => $this->articleImageUrl
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->locale !== null) {
      $parts[] = [
        'name' => 'locale',
        'contents' => $this->locale
      ];
    }

    if ($this->displayMode !== null) {
      $parts[] = [
        'name' => 'display_mode',
        'contents' => $this->displayMode
      ];
    }

    if ($this->genre !== null) {
      foreach ($this->genre ?? [] as $item) {
        $parts[] = [
          'name' => 'genre',
          'contents' => $item
        ];
      }
    }

    if ($this->fiction !== null) {
      $parts[] = [
        'name' => 'fiction',
        'contents' => $this->fiction
      ];
    }

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    if ($this->originalFileType !== null) {
      $parts[] = [
        'name' => 'original_file_type',
        'contents' => $this->originalFileType
      ];
    }

    if ($this->targetAudience !== null) {
      $parts[] = [
        'name' => 'target_audience',
        'contents' => $this->targetAudience
      ];
    }

    if ($this->matureContent !== null) {
      $parts[] = [
        'name' => 'mature_content',
        'contents' => $this->matureContent ? 'true' : 'false'
      ];
    }

    if ($this->safesearchAdult !== null) {
      $parts[] = [
        'name' => 'safesearch_adult',
        'contents' => $this->safesearchAdult ? 'true' : 'false'
      ];
    }

    if ($this->origin !== null) {
      $parts[] = [
        'name' => 'origin',
        'contents' => $this->origin
      ];
    }

    if ($this->publicationDate !== null) {
      $parts[] = [
        'name' => 'publication_date',
        'contents' => $this->publicationDate
      ];
    }

    if ($this->isbn !== null) {
      $parts[] = [
        'name' => 'isbn',
        'contents' => $this->isbn
      ];
    }

    if ($this->ean !== null) {
      $parts[] = [
        'name' => 'ean',
        'contents' => $this->ean
      ];
    }

    if ($this->legalTerms !== null) {
      $parts[] = [
        'name' => 'legal_terms',
        'contents' => json_encode($this->legalTerms),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->contentGuidelinesTerms !== null) {
      $parts[] = [
        'name' => 'content_guidelines_terms',
        'contents' => json_encode($this->contentGuidelinesTerms),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->lastUpdatedFromProjectUnix !== null) {
      $parts[] = [
        'name' => 'last_updated_from_project_unix',
        'contents' => (string) $this->lastUpdatedFromProjectUnix
      ];
    }

    if ($this->publishingProjectId !== null) {
      $parts[] = [
        'name' => 'publishing_project_id',
        'contents' => $this->publishingProjectId
      ];
    }

    if ($this->publishingState !== null) {
      $parts[] = [
        'name' => 'publishing_state',
        'contents' => $this->publishingState
      ];
    }

    if ($this->publisherProfileId !== null) {
      $parts[] = [
        'name' => 'publisher_profile_id',
        'contents' => $this->publisherProfileId
      ];
    }

    if ($this->qualityScore !== null) {
      $parts[] = [
        'name' => 'quality_score',
        'contents' => (string) $this->qualityScore
      ];
    }

    if ($this->publisher !== null) {
      $parts[] = [
        'name' => 'publisher',
        'contents' => $this->publisher
      ];
    }

    if ($this->copyright !== null) {
      $parts[] = [
        'name' => 'copyright',
        'contents' => $this->copyright
      ];
    }

    if ($this->subtitle !== null) {
      $parts[] = [
        'name' => 'subtitle',
        'contents' => $this->subtitle
      ];
    }

    if ($this->distributionTerritories !== null) {
      foreach ($this->distributionTerritories ?? [] as $item) {
        $parts[] = [
          'name' => 'distribution_territories',
          'contents' => $item
        ];
      }
    }

    if ($this->edition !== null) {
      $parts[] = [
        'name' => 'edition',
        'contents' => $this->edition
      ];
    }

    if ($this->contributors !== null) {
      $parts[] = [
        'name' => 'contributors',
        'contents' => json_encode($this->contributors),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->payoutType !== null) {
      $parts[] = [
        'name' => 'payout_type',
        'contents' => $this->payoutType
      ];
    }

    if ($this->listPrice !== null) {
      $parts[] = [
        'name' => 'list_price',
        'contents' => (string) $this->listPrice
      ];
    }

    if ($this->currency !== null) {
      $parts[] = [
        'name' => 'currency',
        'contents' => $this->currency
      ];
    }

    if ($this->originalAudioProjectExportId !== null) {
      $parts[] = [
        'name' => 'original_audio_project_export_id',
        'contents' => $this->originalAudioProjectExportId
      ];
    }

    if ($this->originalAudioDocumentId !== null) {
      $parts[] = [
        'name' => 'original_audio_document_id',
        'contents' => $this->originalAudioDocumentId
      ];
    }

    if ($this->seriesId !== null) {
      $parts[] = [
        'name' => 'series_id',
        'contents' => $this->seriesId
      ];
    }

    if ($this->volume !== null) {
      $parts[] = [
        'name' => 'volume',
        'contents' => (string) $this->volume
      ];
    }

    if ($this->publishedAtUnix !== null) {
      $parts[] = [
        'name' => 'published_at_unix',
        'contents' => (string) $this->publishedAtUnix
      ];
    }

    if ($this->readSlug !== null) {
      $parts[] = [
        'name' => 'read_slug',
        'contents' => $this->readSlug
      ];
    }

    if ($this->previewAudioObject !== null) {
      $parts[] = [
        'name' => 'preview_audio_object',
        'contents' => json_encode($this->previewAudioObject),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sampleConfig !== null) {
      $parts[] = [
        'name' => 'sample_config',
        'contents' => json_encode($this->sampleConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->review !== null) {
      $parts[] = [
        'name' => 'review',
        'contents' => json_encode($this->review),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    if ($this->canUseAssistant !== null) {
      $parts[] = [
        'name' => 'can_use_assistant',
        'contents' => $this->canUseAssistant ? 'true' : 'false'
      ];
    }

    if ($this->isVoiceChangerOn !== null) {
      $parts[] = [
        'name' => 'is_voice_changer_on',
        'contents' => $this->isVoiceChangerOn ? 'true' : 'false'
      ];
    }

    if ($this->restrictedToUserEmailDomains !== null) {
      foreach ($this->restrictedToUserEmailDomains ?? [] as $item) {
        $parts[] = [
          'name' => 'restricted_to_user_email_domains',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chapters as $item) {
      $item->validate();
    }
    $this->legalTerms?->validate();
    $this->contentGuidelinesTerms?->validate();
    foreach ($this->contributors ?? [] as $item) {
      $item->validate();
    }
    $this->previewAudioObject?->validate();
    $this->sampleConfig?->validate();
    $this->review?->validate();
  }
}
