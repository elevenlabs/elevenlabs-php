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
class Voice extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the voice.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * The name of the voice.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @var \ElevenLabs\Types\VoiceSample[]|null
   * List of samples associated with the voice.
   */
  #[JsonProperty('samples'), ArrayType([\ElevenLabs\Types\VoiceSample::class])]
  public ?array $samples;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceCategory>
   */
  #[JsonProperty('category')]
  public ?string $category;

  /**
   * Fine-tuning information for the voice.
   */
  #[JsonProperty('fine_tuning')]
  public ?\ElevenLabs\Types\FineTuningResponse $fineTuning;

  /**
   * @var array<string, string>|null
   * Labels associated with the voice.
   */
  #[JsonProperty('labels'), ArrayType(['string' => 'string'])]
  public ?array $labels;

  /**
   * The description of the voice.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * The preview URL of the voice.
   */
  #[JsonProperty('preview_url')]
  public ?string $previewUrl;

  /**
   * @var string[]|null
   * The tiers the voice is available for.
   */
  #[JsonProperty('available_for_tiers'), ArrayType(['string'])]
  public ?array $availableForTiers;

  /**
   * The settings of the voice.
   */
  #[JsonProperty('settings')]
  public ?\ElevenLabs\Types\VoiceSettings $settings;

  /**
   * The sharing information of the voice.
   */
  #[JsonProperty('sharing')]
  public ?\ElevenLabs\Types\VoiceSharingResponse $sharing;

  /**
   * @var string[]|null
   * The base model IDs for high-quality voices.
   */
  #[JsonProperty('high_quality_base_model_ids'), ArrayType(['string'])]
  public ?array $highQualityBaseModelIds;

  /**
   * @var \ElevenLabs\Types\VerifiedVoiceLanguageResponseModel[]|null
   * The verified languages of the voice.
   */
  #[
    JsonProperty('verified_languages'),
    ArrayType([\ElevenLabs\Types\VerifiedVoiceLanguageResponseModel::class])
  ]
  public ?array $verifiedLanguages;

  /**
   * @var string[]|null
   * The IDs of collections this voice belongs to.
   */
  #[JsonProperty('collection_ids'), ArrayType(['string'])]
  public ?array $collectionIds;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceSafetyControl>
   * The safety controls of the voice.
   */
  #[JsonProperty('safety_control')]
  public ?string $safetyControl;

  /**
   * The voice verification of the voice.
   */
  #[JsonProperty('voice_verification')]
  public ?\ElevenLabs\Types\VoiceVerificationResponse $voiceVerification;

  /**
   * The permission on the resource of the voice.
   */
  #[JsonProperty('permission_on_resource')]
  public ?string $permissionOnResource;

  /**
   * Whether the voice is owned by the user.
   */
  #[JsonProperty('is_owner')]
  public ?bool $isOwner;

  /**
   * Whether the voice is legacy.
   */
  #[JsonProperty('is_legacy')]
  public ?bool $isLegacy;

  /**
   * Whether the voice is mixed.
   */
  #[JsonProperty('is_mixed')]
  public ?bool $isMixed;

  /**
   * Timestamp when the voice was marked as favorite in Unix time.
   */
  #[JsonProperty('favorited_at_unix')]
  public ?int $favoritedAtUnix;

  /**
   * The creation time of the voice in Unix time.
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * Whether the voice is bookmarked by the current user. Only relevant for community (library-copied) voices.
   */
  #[JsonProperty('is_bookmarked')]
  public ?bool $isBookmarked;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceRecordingQuality>
   * The recording quality of the voice as determined by the review pipeline.
   */
  #[JsonProperty('recording_quality')]
  public ?string $recordingQuality;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceLabellingStatus>
   * The review pipeline status of the voice.
   */
  #[JsonProperty('labelling_status')]
  public ?string $labellingStatus;

  /**
   * The reason for the recording quality assessment, as determined by the review pipeline.
   */
  #[JsonProperty('recording_quality_reason')]
  public ?string $recordingQualityReason;

  /**
   * @param array{
   *   voiceId: string,
   *   name?: ?string,
   *   samples?: \ElevenLabs\Types\VoiceSample[]|null,
   *   category?: ?value-of<\ElevenLabs\Types\VoiceCategory>,
   *   fineTuning?: ?\ElevenLabs\Types\FineTuningResponse,
   *   labels?: array<string, string>|null,
   *   description?: ?string,
   *   previewUrl?: ?string,
   *   availableForTiers?: string[]|null,
   *   settings?: ?\ElevenLabs\Types\VoiceSettings,
   *   sharing?: ?\ElevenLabs\Types\VoiceSharingResponse,
   *   highQualityBaseModelIds?: string[]|null,
   *   verifiedLanguages?: \ElevenLabs\Types\VerifiedVoiceLanguageResponseModel[]|null,
   *   collectionIds?: string[]|null,
   *   safetyControl?: ?value-of<\ElevenLabs\Types\VoiceSafetyControl>,
   *   voiceVerification?: ?\ElevenLabs\Types\VoiceVerificationResponse,
   *   permissionOnResource?: ?string,
   *   isOwner?: ?bool,
   *   isLegacy?: ?bool,
   *   isMixed?: ?bool,
   *   favoritedAtUnix?: ?int,
   *   createdAtUnix?: ?int,
   *   isBookmarked?: ?bool,
   *   recordingQuality?: ?value-of<\ElevenLabs\Types\VoiceRecordingQuality>,
   *   labellingStatus?: ?value-of<\ElevenLabs\Types\VoiceLabellingStatus>,
   *   recordingQualityReason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->name = $values['name'] ?? null;
    $this->samples = $values['samples'] ?? null;
    $this->category = $values['category'] ?? null;
    $this->fineTuning = $values['fineTuning'] ?? null;
    $this->labels = $values['labels'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->previewUrl = $values['previewUrl'] ?? null;
    $this->availableForTiers = $values['availableForTiers'] ?? null;
    $this->settings = $values['settings'] ?? null;
    $this->sharing = $values['sharing'] ?? null;
    $this->highQualityBaseModelIds = $values['highQualityBaseModelIds'] ?? null;
    $this->verifiedLanguages = $values['verifiedLanguages'] ?? null;
    $this->collectionIds = $values['collectionIds'] ?? null;
    $this->safetyControl = $values['safetyControl'] ?? null;
    $this->voiceVerification = $values['voiceVerification'] ?? null;
    $this->permissionOnResource = $values['permissionOnResource'] ?? null;
    $this->isOwner = $values['isOwner'] ?? null;
    $this->isLegacy = $values['isLegacy'] ?? null;
    $this->isMixed = $values['isMixed'] ?? null;
    $this->favoritedAtUnix = $values['favoritedAtUnix'] ?? null;
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->isBookmarked = $values['isBookmarked'] ?? null;
    $this->recordingQuality = $values['recordingQuality'] ?? null;
    $this->labellingStatus = $values['labellingStatus'] ?? null;
    $this->recordingQualityReason = $values['recordingQualityReason'] ?? null;

    $this->_dirtyFields = [
      'voice_id' => true
    ];
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('samples', $values)) {
      $this->_dirtyFields['samples'] = true;
    }
    if (array_key_exists('category', $values)) {
      $this->_dirtyFields['category'] = true;
    }
    if (array_key_exists('fineTuning', $values)) {
      $this->_dirtyFields['fine_tuning'] = true;
    }
    if (array_key_exists('labels', $values)) {
      $this->_dirtyFields['labels'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('previewUrl', $values)) {
      $this->_dirtyFields['preview_url'] = true;
    }
    if (array_key_exists('availableForTiers', $values)) {
      $this->_dirtyFields['available_for_tiers'] = true;
    }
    if (array_key_exists('settings', $values)) {
      $this->_dirtyFields['settings'] = true;
    }
    if (array_key_exists('sharing', $values)) {
      $this->_dirtyFields['sharing'] = true;
    }
    if (array_key_exists('highQualityBaseModelIds', $values)) {
      $this->_dirtyFields['high_quality_base_model_ids'] = true;
    }
    if (array_key_exists('verifiedLanguages', $values)) {
      $this->_dirtyFields['verified_languages'] = true;
    }
    if (array_key_exists('collectionIds', $values)) {
      $this->_dirtyFields['collection_ids'] = true;
    }
    if (array_key_exists('safetyControl', $values)) {
      $this->_dirtyFields['safety_control'] = true;
    }
    if (array_key_exists('voiceVerification', $values)) {
      $this->_dirtyFields['voice_verification'] = true;
    }
    if (array_key_exists('permissionOnResource', $values)) {
      $this->_dirtyFields['permission_on_resource'] = true;
    }
    if (array_key_exists('isOwner', $values)) {
      $this->_dirtyFields['is_owner'] = true;
    }
    if (array_key_exists('isLegacy', $values)) {
      $this->_dirtyFields['is_legacy'] = true;
    }
    if (array_key_exists('isMixed', $values)) {
      $this->_dirtyFields['is_mixed'] = true;
    }
    if (array_key_exists('favoritedAtUnix', $values)) {
      $this->_dirtyFields['favorited_at_unix'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('isBookmarked', $values)) {
      $this->_dirtyFields['is_bookmarked'] = true;
    }
    if (array_key_exists('recordingQuality', $values)) {
      $this->_dirtyFields['recording_quality'] = true;
    }
    if (array_key_exists('labellingStatus', $values)) {
      $this->_dirtyFields['labelling_status'] = true;
    }
    if (array_key_exists('recordingQualityReason', $values)) {
      $this->_dirtyFields['recording_quality_reason'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->samples !== null) {
      $parts[] = [
        'name' => 'samples',
        'contents' => json_encode($this->samples),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->category !== null) {
      $parts[] = [
        'name' => 'category',
        'contents' => $this->category
      ];
    }

    if ($this->fineTuning !== null) {
      $parts[] = [
        'name' => 'fine_tuning',
        'contents' => json_encode($this->fineTuning),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->labels !== null) {
      $parts[] = [
        'name' => 'labels',
        'contents' => json_encode($this->labels),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->previewUrl !== null) {
      $parts[] = [
        'name' => 'preview_url',
        'contents' => $this->previewUrl
      ];
    }

    if ($this->availableForTiers !== null) {
      foreach ($this->availableForTiers ?? [] as $item) {
        $parts[] = [
          'name' => 'available_for_tiers',
          'contents' => $item
        ];
      }
    }

    if ($this->settings !== null) {
      $parts[] = [
        'name' => 'settings',
        'contents' => json_encode($this->settings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sharing !== null) {
      $parts[] = [
        'name' => 'sharing',
        'contents' => json_encode($this->sharing),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->highQualityBaseModelIds !== null) {
      foreach ($this->highQualityBaseModelIds ?? [] as $item) {
        $parts[] = [
          'name' => 'high_quality_base_model_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->verifiedLanguages !== null) {
      $parts[] = [
        'name' => 'verified_languages',
        'contents' => json_encode($this->verifiedLanguages),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->collectionIds !== null) {
      foreach ($this->collectionIds ?? [] as $item) {
        $parts[] = [
          'name' => 'collection_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->safetyControl !== null) {
      $parts[] = [
        'name' => 'safety_control',
        'contents' => $this->safetyControl
      ];
    }

    if ($this->voiceVerification !== null) {
      $parts[] = [
        'name' => 'voice_verification',
        'contents' => json_encode($this->voiceVerification),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->permissionOnResource !== null) {
      $parts[] = [
        'name' => 'permission_on_resource',
        'contents' => $this->permissionOnResource
      ];
    }

    if ($this->isOwner !== null) {
      $parts[] = [
        'name' => 'is_owner',
        'contents' => $this->isOwner ? 'true' : 'false'
      ];
    }

    if ($this->isLegacy !== null) {
      $parts[] = [
        'name' => 'is_legacy',
        'contents' => $this->isLegacy ? 'true' : 'false'
      ];
    }

    if ($this->isMixed !== null) {
      $parts[] = [
        'name' => 'is_mixed',
        'contents' => $this->isMixed ? 'true' : 'false'
      ];
    }

    if ($this->favoritedAtUnix !== null) {
      $parts[] = [
        'name' => 'favorited_at_unix',
        'contents' => (string) $this->favoritedAtUnix
      ];
    }

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    if ($this->isBookmarked !== null) {
      $parts[] = [
        'name' => 'is_bookmarked',
        'contents' => $this->isBookmarked ? 'true' : 'false'
      ];
    }

    if ($this->recordingQuality !== null) {
      $parts[] = [
        'name' => 'recording_quality',
        'contents' => $this->recordingQuality
      ];
    }

    if ($this->labellingStatus !== null) {
      $parts[] = [
        'name' => 'labelling_status',
        'contents' => $this->labellingStatus
      ];
    }

    if ($this->recordingQualityReason !== null) {
      $parts[] = [
        'name' => 'recording_quality_reason',
        'contents' => $this->recordingQualityReason
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->samples ?? [] as $item) {
      $item->validate();
    }
    $this->fineTuning?->validate();
    $this->settings?->validate();
    $this->sharing?->validate();
    foreach ($this->verifiedLanguages ?? [] as $item) {
      $item->validate();
    }
    $this->voiceVerification?->validate();
  }
}
