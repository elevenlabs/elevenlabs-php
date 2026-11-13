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
class VoiceSharingResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceSharingState>
   * The status of the voice sharing.
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * The sample ID of the history item.
   */
  #[JsonProperty('history_item_sample_id')]
  public ?string $historyItemSampleId;

  /**
   * The Unix time, in seconds, at which the voice was shared.
   */
  #[JsonProperty('date_unix')]
  public ?int $dateUnix;

  /**
   * @var string[]|null
   * A list of whitelisted emails.
   */
  #[JsonProperty('whitelisted_emails'), ArrayType(['string'])]
  public ?array $whitelistedEmails;

  /**
   * The ID of the public owner.
   */
  #[JsonProperty('public_owner_id')]
  public ?string $publicOwnerId;

  /**
   * The ID of the original voice.
   */
  #[JsonProperty('original_voice_id')]
  public ?string $originalVoiceId;

  /**
   * Whether financial rewards are enabled.
   */
  #[JsonProperty('financial_rewards_enabled')]
  public ?bool $financialRewardsEnabled;

  /**
   * Whether free users are allowed.
   */
  #[JsonProperty('free_users_allowed')]
  public ?bool $freeUsersAllowed;

  /**
   * Whether live moderation is enabled.
   */
  #[JsonProperty('live_moderation_enabled')]
  public ?bool $liveModerationEnabled;

  /**
   * The rate of the voice sharing.
   */
  #[JsonProperty('rate')]
  public ?float $rate;

  /**
   * The rate of the voice sharing in USD per 1000 credits.
   */
  #[JsonProperty('fiat_rate')]
  public ?float $fiatRate;

  /**
   * The notice period of the voice sharing.
   */
  #[JsonProperty('notice_period')]
  public ?int $noticePeriod;

  /**
   * The Unix time, in seconds, at which users who added the voice from the Voice Library lose access to it.
   */
  #[JsonProperty('disable_at_unix')]
  public ?int $disableAtUnix;

  /**
   * Whether voice mixing is allowed.
   */
  #[JsonProperty('voice_mixing_allowed')]
  public ?bool $voiceMixingAllowed;

  /**
   * Whether the voice is featured.
   */
  #[JsonProperty('featured')]
  public ?bool $featured;

  /**
   * @var ?value-of<\ElevenLabs\Types\VoiceSharingResponseCategory>
   * The category of the voice.
   */
  #[JsonProperty('category')]
  public ?string $category;

  /**
   * Whether the reader app is enabled.
   */
  #[JsonProperty('reader_app_enabled')]
  public ?bool $readerAppEnabled;

  /**
   * The image URL of the voice.
   */
  #[JsonProperty('image_url')]
  public ?string $imageUrl;

  /**
   * The ban reason of the voice.
   */
  #[JsonProperty('ban_reason')]
  public ?string $banReason;

  /**
   * The number of likes on the voice.
   */
  #[JsonProperty('liked_by_count')]
  public ?int $likedByCount;

  /**
   * The number of clones on the voice.
   */
  #[JsonProperty('cloned_by_count')]
  public ?int $clonedByCount;

  /**
   * The name of the voice.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * The description of the voice.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var array<string, string>|null
   * The labels of the voice.
   */
  #[JsonProperty('labels'), ArrayType(['string' => 'string'])]
  public ?array $labels;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReviewStatus>
   * The review status of the voice.
   */
  #[JsonProperty('review_status')]
  public ?string $reviewStatus;

  /**
   * The review message of the voice.
   */
  #[JsonProperty('review_message')]
  public ?string $reviewMessage;

  /**
   * Whether the voice is enabled in the library.
   */
  #[JsonProperty('enabled_in_library')]
  public ?bool $enabledInLibrary;

  /**
   * The Instagram username of the voice.
   */
  #[JsonProperty('instagram_username')]
  public ?string $instagramUsername;

  /**
   * The Twitter/X username of the voice.
   */
  #[JsonProperty('twitter_username')]
  public ?string $twitterUsername;

  /**
   * The YouTube username of the voice.
   */
  #[JsonProperty('youtube_username')]
  public ?string $youtubeUsername;

  /**
   * The TikTok username of the voice.
   */
  #[JsonProperty('tiktok_username')]
  public ?string $tiktokUsername;

  /**
   * The moderation check of the voice.
   */
  #[JsonProperty('moderation_check')]
  public ?\ElevenLabs\Types\VoiceSharingModerationCheckResponseModel $moderationCheck;

  /**
   * @var \ElevenLabs\Types\ReaderResourceResponseModel[]|null
   * The reader restricted on of the voice.
   */
  #[
    JsonProperty('reader_restricted_on'),
    ArrayType([\ElevenLabs\Types\ReaderResourceResponseModel::class])
  ]
  public ?array $readerRestrictedOn;

  /**
   * @param array{
   *   status?: ?value-of<\ElevenLabs\Types\VoiceSharingState>,
   *   historyItemSampleId?: ?string,
   *   dateUnix?: ?int,
   *   whitelistedEmails?: string[]|null,
   *   publicOwnerId?: ?string,
   *   originalVoiceId?: ?string,
   *   financialRewardsEnabled?: ?bool,
   *   freeUsersAllowed?: ?bool,
   *   liveModerationEnabled?: ?bool,
   *   rate?: ?float,
   *   fiatRate?: ?float,
   *   noticePeriod?: ?int,
   *   disableAtUnix?: ?int,
   *   voiceMixingAllowed?: ?bool,
   *   featured?: ?bool,
   *   category?: ?value-of<\ElevenLabs\Types\VoiceSharingResponseCategory>,
   *   readerAppEnabled?: ?bool,
   *   imageUrl?: ?string,
   *   banReason?: ?string,
   *   likedByCount?: ?int,
   *   clonedByCount?: ?int,
   *   name?: ?string,
   *   description?: ?string,
   *   labels?: array<string, string>|null,
   *   reviewStatus?: ?value-of<\ElevenLabs\Types\ReviewStatus>,
   *   reviewMessage?: ?string,
   *   enabledInLibrary?: ?bool,
   *   instagramUsername?: ?string,
   *   twitterUsername?: ?string,
   *   youtubeUsername?: ?string,
   *   tiktokUsername?: ?string,
   *   moderationCheck?: ?\ElevenLabs\Types\VoiceSharingModerationCheckResponseModel,
   *   readerRestrictedOn?: \ElevenLabs\Types\ReaderResourceResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->status = $values['status'] ?? null;
    $this->historyItemSampleId = $values['historyItemSampleId'] ?? null;
    $this->dateUnix = $values['dateUnix'] ?? null;
    $this->whitelistedEmails = $values['whitelistedEmails'] ?? null;
    $this->publicOwnerId = $values['publicOwnerId'] ?? null;
    $this->originalVoiceId = $values['originalVoiceId'] ?? null;
    $this->financialRewardsEnabled = $values['financialRewardsEnabled'] ?? null;
    $this->freeUsersAllowed = $values['freeUsersAllowed'] ?? null;
    $this->liveModerationEnabled = $values['liveModerationEnabled'] ?? null;
    $this->rate = $values['rate'] ?? null;
    $this->fiatRate = $values['fiatRate'] ?? null;
    $this->noticePeriod = $values['noticePeriod'] ?? null;
    $this->disableAtUnix = $values['disableAtUnix'] ?? null;
    $this->voiceMixingAllowed = $values['voiceMixingAllowed'] ?? null;
    $this->featured = $values['featured'] ?? null;
    $this->category = $values['category'] ?? null;
    $this->readerAppEnabled = $values['readerAppEnabled'] ?? null;
    $this->imageUrl = $values['imageUrl'] ?? null;
    $this->banReason = $values['banReason'] ?? null;
    $this->likedByCount = $values['likedByCount'] ?? null;
    $this->clonedByCount = $values['clonedByCount'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->labels = $values['labels'] ?? null;
    $this->reviewStatus = $values['reviewStatus'] ?? null;
    $this->reviewMessage = $values['reviewMessage'] ?? null;
    $this->enabledInLibrary = $values['enabledInLibrary'] ?? null;
    $this->instagramUsername = $values['instagramUsername'] ?? null;
    $this->twitterUsername = $values['twitterUsername'] ?? null;
    $this->youtubeUsername = $values['youtubeUsername'] ?? null;
    $this->tiktokUsername = $values['tiktokUsername'] ?? null;
    $this->moderationCheck = $values['moderationCheck'] ?? null;
    $this->readerRestrictedOn = $values['readerRestrictedOn'] ?? null;

    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('historyItemSampleId', $values)) {
      $this->_dirtyFields['history_item_sample_id'] = true;
    }
    if (array_key_exists('dateUnix', $values)) {
      $this->_dirtyFields['date_unix'] = true;
    }
    if (array_key_exists('whitelistedEmails', $values)) {
      $this->_dirtyFields['whitelisted_emails'] = true;
    }
    if (array_key_exists('publicOwnerId', $values)) {
      $this->_dirtyFields['public_owner_id'] = true;
    }
    if (array_key_exists('originalVoiceId', $values)) {
      $this->_dirtyFields['original_voice_id'] = true;
    }
    if (array_key_exists('financialRewardsEnabled', $values)) {
      $this->_dirtyFields['financial_rewards_enabled'] = true;
    }
    if (array_key_exists('freeUsersAllowed', $values)) {
      $this->_dirtyFields['free_users_allowed'] = true;
    }
    if (array_key_exists('liveModerationEnabled', $values)) {
      $this->_dirtyFields['live_moderation_enabled'] = true;
    }
    if (array_key_exists('rate', $values)) {
      $this->_dirtyFields['rate'] = true;
    }
    if (array_key_exists('fiatRate', $values)) {
      $this->_dirtyFields['fiat_rate'] = true;
    }
    if (array_key_exists('noticePeriod', $values)) {
      $this->_dirtyFields['notice_period'] = true;
    }
    if (array_key_exists('disableAtUnix', $values)) {
      $this->_dirtyFields['disable_at_unix'] = true;
    }
    if (array_key_exists('voiceMixingAllowed', $values)) {
      $this->_dirtyFields['voice_mixing_allowed'] = true;
    }
    if (array_key_exists('featured', $values)) {
      $this->_dirtyFields['featured'] = true;
    }
    if (array_key_exists('category', $values)) {
      $this->_dirtyFields['category'] = true;
    }
    if (array_key_exists('readerAppEnabled', $values)) {
      $this->_dirtyFields['reader_app_enabled'] = true;
    }
    if (array_key_exists('imageUrl', $values)) {
      $this->_dirtyFields['image_url'] = true;
    }
    if (array_key_exists('banReason', $values)) {
      $this->_dirtyFields['ban_reason'] = true;
    }
    if (array_key_exists('likedByCount', $values)) {
      $this->_dirtyFields['liked_by_count'] = true;
    }
    if (array_key_exists('clonedByCount', $values)) {
      $this->_dirtyFields['cloned_by_count'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('labels', $values)) {
      $this->_dirtyFields['labels'] = true;
    }
    if (array_key_exists('reviewStatus', $values)) {
      $this->_dirtyFields['review_status'] = true;
    }
    if (array_key_exists('reviewMessage', $values)) {
      $this->_dirtyFields['review_message'] = true;
    }
    if (array_key_exists('enabledInLibrary', $values)) {
      $this->_dirtyFields['enabled_in_library'] = true;
    }
    if (array_key_exists('instagramUsername', $values)) {
      $this->_dirtyFields['instagram_username'] = true;
    }
    if (array_key_exists('twitterUsername', $values)) {
      $this->_dirtyFields['twitter_username'] = true;
    }
    if (array_key_exists('youtubeUsername', $values)) {
      $this->_dirtyFields['youtube_username'] = true;
    }
    if (array_key_exists('tiktokUsername', $values)) {
      $this->_dirtyFields['tiktok_username'] = true;
    }
    if (array_key_exists('moderationCheck', $values)) {
      $this->_dirtyFields['moderation_check'] = true;
    }
    if (array_key_exists('readerRestrictedOn', $values)) {
      $this->_dirtyFields['reader_restricted_on'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->historyItemSampleId !== null) {
      $parts[] = [
        'name' => 'history_item_sample_id',
        'contents' => $this->historyItemSampleId
      ];
    }

    if ($this->dateUnix !== null) {
      $parts[] = [
        'name' => 'date_unix',
        'contents' => (string) $this->dateUnix
      ];
    }

    if ($this->whitelistedEmails !== null) {
      foreach ($this->whitelistedEmails ?? [] as $item) {
        $parts[] = [
          'name' => 'whitelisted_emails',
          'contents' => $item
        ];
      }
    }

    if ($this->publicOwnerId !== null) {
      $parts[] = [
        'name' => 'public_owner_id',
        'contents' => $this->publicOwnerId
      ];
    }

    if ($this->originalVoiceId !== null) {
      $parts[] = [
        'name' => 'original_voice_id',
        'contents' => $this->originalVoiceId
      ];
    }

    if ($this->financialRewardsEnabled !== null) {
      $parts[] = [
        'name' => 'financial_rewards_enabled',
        'contents' => $this->financialRewardsEnabled ? 'true' : 'false'
      ];
    }

    if ($this->freeUsersAllowed !== null) {
      $parts[] = [
        'name' => 'free_users_allowed',
        'contents' => $this->freeUsersAllowed ? 'true' : 'false'
      ];
    }

    if ($this->liveModerationEnabled !== null) {
      $parts[] = [
        'name' => 'live_moderation_enabled',
        'contents' => $this->liveModerationEnabled ? 'true' : 'false'
      ];
    }

    if ($this->rate !== null) {
      $parts[] = [
        'name' => 'rate',
        'contents' => (string) $this->rate
      ];
    }

    if ($this->fiatRate !== null) {
      $parts[] = [
        'name' => 'fiat_rate',
        'contents' => (string) $this->fiatRate
      ];
    }

    if ($this->noticePeriod !== null) {
      $parts[] = [
        'name' => 'notice_period',
        'contents' => (string) $this->noticePeriod
      ];
    }

    if ($this->disableAtUnix !== null) {
      $parts[] = [
        'name' => 'disable_at_unix',
        'contents' => (string) $this->disableAtUnix
      ];
    }

    if ($this->voiceMixingAllowed !== null) {
      $parts[] = [
        'name' => 'voice_mixing_allowed',
        'contents' => $this->voiceMixingAllowed ? 'true' : 'false'
      ];
    }

    if ($this->featured !== null) {
      $parts[] = [
        'name' => 'featured',
        'contents' => $this->featured ? 'true' : 'false'
      ];
    }

    if ($this->category !== null) {
      $parts[] = [
        'name' => 'category',
        'contents' => $this->category
      ];
    }

    if ($this->readerAppEnabled !== null) {
      $parts[] = [
        'name' => 'reader_app_enabled',
        'contents' => $this->readerAppEnabled ? 'true' : 'false'
      ];
    }

    if ($this->imageUrl !== null) {
      $parts[] = [
        'name' => 'image_url',
        'contents' => $this->imageUrl
      ];
    }

    if ($this->banReason !== null) {
      $parts[] = [
        'name' => 'ban_reason',
        'contents' => $this->banReason
      ];
    }

    if ($this->likedByCount !== null) {
      $parts[] = [
        'name' => 'liked_by_count',
        'contents' => (string) $this->likedByCount
      ];
    }

    if ($this->clonedByCount !== null) {
      $parts[] = [
        'name' => 'cloned_by_count',
        'contents' => (string) $this->clonedByCount
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->labels !== null) {
      $parts[] = [
        'name' => 'labels',
        'contents' => json_encode($this->labels),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->reviewStatus !== null) {
      $parts[] = [
        'name' => 'review_status',
        'contents' => $this->reviewStatus
      ];
    }

    if ($this->reviewMessage !== null) {
      $parts[] = [
        'name' => 'review_message',
        'contents' => $this->reviewMessage
      ];
    }

    if ($this->enabledInLibrary !== null) {
      $parts[] = [
        'name' => 'enabled_in_library',
        'contents' => $this->enabledInLibrary ? 'true' : 'false'
      ];
    }

    if ($this->instagramUsername !== null) {
      $parts[] = [
        'name' => 'instagram_username',
        'contents' => $this->instagramUsername
      ];
    }

    if ($this->twitterUsername !== null) {
      $parts[] = [
        'name' => 'twitter_username',
        'contents' => $this->twitterUsername
      ];
    }

    if ($this->youtubeUsername !== null) {
      $parts[] = [
        'name' => 'youtube_username',
        'contents' => $this->youtubeUsername
      ];
    }

    if ($this->tiktokUsername !== null) {
      $parts[] = [
        'name' => 'tiktok_username',
        'contents' => $this->tiktokUsername
      ];
    }

    if ($this->moderationCheck !== null) {
      $parts[] = [
        'name' => 'moderation_check',
        'contents' => json_encode($this->moderationCheck),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->readerRestrictedOn !== null) {
      $parts[] = [
        'name' => 'reader_restricted_on',
        'contents' => json_encode($this->readerRestrictedOn),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->moderationCheck?->validate();
    foreach ($this->readerRestrictedOn ?? [] as $item) {
      $item->validate();
    }
  }
}
