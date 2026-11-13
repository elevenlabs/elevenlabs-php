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
class LibraryVoiceResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The public owner id of the voice.
   */
  #[JsonProperty('public_owner_id', required: true)]
  public string $publicOwnerId;

  /**
   * The id of the voice.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * The date the voice was added to the library in Unix time.
   */
  #[JsonProperty('date_unix', required: true)]
  public int $dateUnix;

  /**
   * The name of the voice.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The accent of the voice.
   */
  #[JsonProperty('accent', required: true)]
  public string $accent;

  /**
   * The gender of the voice.
   */
  #[JsonProperty('gender', required: true)]
  public string $gender;

  /**
   * The age of the voice.
   */
  #[JsonProperty('age', required: true)]
  public string $age;

  /**
   * The descriptive of the voice.
   */
  #[JsonProperty('descriptive', required: true)]
  public string $descriptive;

  /**
   * The use case of the voice.
   */
  #[JsonProperty('use_case', required: true)]
  public string $useCase;

  /**
   * @var value-of<\ElevenLabs\Types\LibraryVoiceResponseCategory>
   * The category of the voice.
   */
  #[JsonProperty('category', required: true)]
  public string $category;

  /**
   * The language of the voice.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * The locale of the voice.
   */
  #[JsonProperty('locale')]
  public ?string $locale;

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
   * The usage character count of the voice in the last year.
   */
  #[JsonProperty('usage_character_count_1y', required: true)]
  public int $usageCharacterCount1Y;

  /**
   * The usage character count of the voice in the last 7 days.
   */
  #[JsonProperty('usage_character_count_7d', required: true)]
  public int $usageCharacterCount7D;

  /**
   * The play API usage character count of the voice in the last year.
   */
  #[JsonProperty('play_api_usage_character_count_1y', required: true)]
  public int $playApiUsageCharacterCount1Y;

  /**
   * The number of times the voice has been cloned.
   */
  #[JsonProperty('cloned_by_count', required: true)]
  public int $clonedByCount;

  /**
   * The rate multiplier of the voice.
   */
  #[JsonProperty('rate')]
  public ?float $rate;

  /**
   * The rate of the voice in USD per 1000 credits. null if default
   */
  #[JsonProperty('fiat_rate')]
  public ?float $fiatRate;

  /**
   * Whether free users are allowed to use the voice.
   */
  #[JsonProperty('free_users_allowed', required: true)]
  public bool $freeUsersAllowed;

  /**
   * Whether live moderation is enabled for the voice.
   */
  #[JsonProperty('live_moderation_enabled', required: true)]
  public bool $liveModerationEnabled;

  /**
   * Whether the voice is featured.
   */
  #[JsonProperty('featured', required: true)]
  public bool $featured;

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
   * The notice period of the voice.
   */
  #[JsonProperty('notice_period')]
  public ?int $noticePeriod;

  /**
   * The Instagram username of the voice.
   */
  #[JsonProperty('instagram_username')]
  public ?string $instagramUsername;

  /**
   * The Twitter username of the voice.
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
   * The image URL of the voice.
   */
  #[JsonProperty('image_url')]
  public ?string $imageUrl;

  /**
   * Whether the voice was added by the user.
   */
  #[JsonProperty('is_added_by_user')]
  public ?bool $isAddedByUser;

  /**
   * Whether the voice is bookmarked by the current user. Only relevant when is_added_by_user is True.
   */
  #[JsonProperty('is_bookmarked')]
  public ?bool $isBookmarked;

  /**
   * @param array{
   *   publicOwnerId: string,
   *   voiceId: string,
   *   dateUnix: int,
   *   name: string,
   *   accent: string,
   *   gender: string,
   *   age: string,
   *   descriptive: string,
   *   useCase: string,
   *   category: value-of<\ElevenLabs\Types\LibraryVoiceResponseCategory>,
   *   usageCharacterCount1Y: int,
   *   usageCharacterCount7D: int,
   *   playApiUsageCharacterCount1Y: int,
   *   clonedByCount: int,
   *   freeUsersAllowed: bool,
   *   liveModerationEnabled: bool,
   *   featured: bool,
   *   language?: ?string,
   *   locale?: ?string,
   *   description?: ?string,
   *   previewUrl?: ?string,
   *   rate?: ?float,
   *   fiatRate?: ?float,
   *   verifiedLanguages?: \ElevenLabs\Types\VerifiedVoiceLanguageResponseModel[]|null,
   *   noticePeriod?: ?int,
   *   instagramUsername?: ?string,
   *   twitterUsername?: ?string,
   *   youtubeUsername?: ?string,
   *   tiktokUsername?: ?string,
   *   imageUrl?: ?string,
   *   isAddedByUser?: ?bool,
   *   isBookmarked?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->publicOwnerId = $values['publicOwnerId'];
    $this->voiceId = $values['voiceId'];
    $this->dateUnix = $values['dateUnix'];
    $this->name = $values['name'];
    $this->accent = $values['accent'];
    $this->gender = $values['gender'];
    $this->age = $values['age'];
    $this->descriptive = $values['descriptive'];
    $this->useCase = $values['useCase'];
    $this->category = $values['category'];
    $this->language = $values['language'] ?? null;
    $this->locale = $values['locale'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->previewUrl = $values['previewUrl'] ?? null;
    $this->usageCharacterCount1Y = $values['usageCharacterCount1Y'];
    $this->usageCharacterCount7D = $values['usageCharacterCount7D'];
    $this->playApiUsageCharacterCount1Y = $values['playApiUsageCharacterCount1Y'];
    $this->clonedByCount = $values['clonedByCount'];
    $this->rate = $values['rate'] ?? null;
    $this->fiatRate = $values['fiatRate'] ?? null;
    $this->freeUsersAllowed = $values['freeUsersAllowed'];
    $this->liveModerationEnabled = $values['liveModerationEnabled'];
    $this->featured = $values['featured'];
    $this->verifiedLanguages = $values['verifiedLanguages'] ?? null;
    $this->noticePeriod = $values['noticePeriod'] ?? null;
    $this->instagramUsername = $values['instagramUsername'] ?? null;
    $this->twitterUsername = $values['twitterUsername'] ?? null;
    $this->youtubeUsername = $values['youtubeUsername'] ?? null;
    $this->tiktokUsername = $values['tiktokUsername'] ?? null;
    $this->imageUrl = $values['imageUrl'] ?? null;
    $this->isAddedByUser = $values['isAddedByUser'] ?? null;
    $this->isBookmarked = $values['isBookmarked'] ?? null;

    $this->_dirtyFields = [
      'public_owner_id' => true,
      'voice_id' => true,
      'date_unix' => true,
      'name' => true,
      'accent' => true,
      'gender' => true,
      'age' => true,
      'descriptive' => true,
      'use_case' => true,
      'category' => true,
      'usage_character_count_1y' => true,
      'usage_character_count_7d' => true,
      'play_api_usage_character_count_1y' => true,
      'cloned_by_count' => true,
      'free_users_allowed' => true,
      'live_moderation_enabled' => true,
      'featured' => true
    ];
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('locale', $values)) {
      $this->_dirtyFields['locale'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('previewUrl', $values)) {
      $this->_dirtyFields['preview_url'] = true;
    }
    if (array_key_exists('rate', $values)) {
      $this->_dirtyFields['rate'] = true;
    }
    if (array_key_exists('fiatRate', $values)) {
      $this->_dirtyFields['fiat_rate'] = true;
    }
    if (array_key_exists('verifiedLanguages', $values)) {
      $this->_dirtyFields['verified_languages'] = true;
    }
    if (array_key_exists('noticePeriod', $values)) {
      $this->_dirtyFields['notice_period'] = true;
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
    if (array_key_exists('imageUrl', $values)) {
      $this->_dirtyFields['image_url'] = true;
    }
    if (array_key_exists('isAddedByUser', $values)) {
      $this->_dirtyFields['is_added_by_user'] = true;
    }
    if (array_key_exists('isBookmarked', $values)) {
      $this->_dirtyFields['is_bookmarked'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'public_owner_id',
      'contents' => $this->publicOwnerId
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'date_unix',
      'contents' => (string) $this->dateUnix
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'accent',
      'contents' => $this->accent
    ];

    $parts[] = [
      'name' => 'gender',
      'contents' => $this->gender
    ];

    $parts[] = [
      'name' => 'age',
      'contents' => $this->age
    ];

    $parts[] = [
      'name' => 'descriptive',
      'contents' => $this->descriptive
    ];

    $parts[] = [
      'name' => 'use_case',
      'contents' => $this->useCase
    ];

    $parts[] = [
      'name' => 'category',
      'contents' => $this->category
    ];

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

    $parts[] = [
      'name' => 'usage_character_count_1y',
      'contents' => (string) $this->usageCharacterCount1Y
    ];

    $parts[] = [
      'name' => 'usage_character_count_7d',
      'contents' => (string) $this->usageCharacterCount7D
    ];

    $parts[] = [
      'name' => 'play_api_usage_character_count_1y',
      'contents' => (string) $this->playApiUsageCharacterCount1Y
    ];

    $parts[] = [
      'name' => 'cloned_by_count',
      'contents' => (string) $this->clonedByCount
    ];

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

    $parts[] = [
      'name' => 'free_users_allowed',
      'contents' => $this->freeUsersAllowed ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'live_moderation_enabled',
      'contents' => $this->liveModerationEnabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'featured',
      'contents' => $this->featured ? 'true' : 'false'
    ];

    if ($this->verifiedLanguages !== null) {
      $parts[] = [
        'name' => 'verified_languages',
        'contents' => json_encode($this->verifiedLanguages),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->noticePeriod !== null) {
      $parts[] = [
        'name' => 'notice_period',
        'contents' => (string) $this->noticePeriod
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

    if ($this->imageUrl !== null) {
      $parts[] = [
        'name' => 'image_url',
        'contents' => $this->imageUrl
      ];
    }

    if ($this->isAddedByUser !== null) {
      $parts[] = [
        'name' => 'is_added_by_user',
        'contents' => $this->isAddedByUser ? 'true' : 'false'
      ];
    }

    if ($this->isBookmarked !== null) {
      $parts[] = [
        'name' => 'is_bookmarked',
        'contents' => $this->isBookmarked ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->verifiedLanguages ?? [] as $item) {
      $item->validate();
    }
  }
}
