<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubscriptionExtrasResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The concurrency of the user.
   */
  #[JsonProperty('concurrency', required: true)]
  public int $concurrency;

  /**
   * The Convai concurrency of the user.
   */
  #[JsonProperty('convai_concurrency', required: true)]
  public int $convaiConcurrency;

  /**
   * The Music concurrency of the user on enterprise plan.
   */
  #[JsonProperty('enterprise_music_concurrency')]
  public ?int $enterpriseMusicConcurrency;

  /**
   * Custom total finetunes limit for the user.
   */
  #[JsonProperty('music_finetunes_total_limit')]
  public ?int $musicFinetunesTotalLimit;

  /**
   * Custom monthly finetunes limit for the user.
   */
  #[JsonProperty('music_finetunes_monthly_limit')]
  public ?int $musicFinetunesMonthlyLimit;

  /**
   * Custom finetunes concurrency limit for the user.
   */
  #[JsonProperty('music_finetunes_concurrency_limit')]
  public ?int $musicFinetunesConcurrencyLimit;

  /**
   * The Convai characters per minute of the user. This field is deprecated and will always return None.
   */
  #[JsonProperty('convai_chars_per_minute')]
  public ?int $convaiCharsPerMinute;

  /**
   * The Convai ASR characters per minute of the user. This field is deprecated and will always return None.
   */
  #[JsonProperty('convai_asr_chars_per_minute')]
  public ?int $convaiAsrCharsPerMinute;

  /**
   * Whether the user's logging is disabled.
   */
  #[JsonProperty('force_logging_disabled', required: true)]
  public bool $forceLoggingDisabled;

  /**
   * Whether the user can request manual pro voice verification.
   */
  #[JsonProperty('can_request_manual_pro_voice_verification', required: true)]
  public bool $canRequestManualProVoiceVerification;

  /**
   * Whether the user can bypass the voice captcha.
   */
  #[JsonProperty('can_bypass_voice_captcha', required: true)]
  public bool $canBypassVoiceCaptcha;

  #[JsonProperty('moderation', required: true)]
  public \ElevenLabs\Types\ModerationStatusResponseModel $moderation;

  /**
   * The unused characters rolled over from the previous period.
   */
  #[JsonProperty('unused_characters_rolled_over_from_previous_period')]
  public ?int $unusedCharactersRolledOverFromPreviousPeriod;

  /**
   * The overused characters rolled over from the previous period.
   */
  #[JsonProperty('overused_characters_rolled_over_from_previous_period')]
  public ?int $overusedCharactersRolledOverFromPreviousPeriod;

  /**
   * Data on how the subscription is being used.
   */
  #[JsonProperty('usage')]
  public ?\ElevenLabs\Types\SubscriptionUsageResponseModel $usage;

  /**
   * @param array{
   *   concurrency: int,
   *   convaiConcurrency: int,
   *   forceLoggingDisabled: bool,
   *   canRequestManualProVoiceVerification: bool,
   *   canBypassVoiceCaptcha: bool,
   *   moderation: \ElevenLabs\Types\ModerationStatusResponseModel,
   *   enterpriseMusicConcurrency?: ?int,
   *   musicFinetunesTotalLimit?: ?int,
   *   musicFinetunesMonthlyLimit?: ?int,
   *   musicFinetunesConcurrencyLimit?: ?int,
   *   convaiCharsPerMinute?: ?int,
   *   convaiAsrCharsPerMinute?: ?int,
   *   unusedCharactersRolledOverFromPreviousPeriod?: ?int,
   *   overusedCharactersRolledOverFromPreviousPeriod?: ?int,
   *   usage?: ?\ElevenLabs\Types\SubscriptionUsageResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->concurrency = $values['concurrency'];
    $this->convaiConcurrency = $values['convaiConcurrency'];
    $this->enterpriseMusicConcurrency = $values['enterpriseMusicConcurrency'] ?? null;
    $this->musicFinetunesTotalLimit = $values['musicFinetunesTotalLimit'] ?? null;
    $this->musicFinetunesMonthlyLimit = $values['musicFinetunesMonthlyLimit'] ?? null;
    $this->musicFinetunesConcurrencyLimit = $values['musicFinetunesConcurrencyLimit'] ?? null;
    $this->convaiCharsPerMinute = $values['convaiCharsPerMinute'] ?? null;
    $this->convaiAsrCharsPerMinute = $values['convaiAsrCharsPerMinute'] ?? null;
    $this->forceLoggingDisabled = $values['forceLoggingDisabled'];
    $this->canRequestManualProVoiceVerification = $values['canRequestManualProVoiceVerification'];
    $this->canBypassVoiceCaptcha = $values['canBypassVoiceCaptcha'];
    $this->moderation = $values['moderation'];
    $this->unusedCharactersRolledOverFromPreviousPeriod =
      $values['unusedCharactersRolledOverFromPreviousPeriod'] ?? null;
    $this->overusedCharactersRolledOverFromPreviousPeriod =
      $values['overusedCharactersRolledOverFromPreviousPeriod'] ?? null;
    $this->usage = $values['usage'] ?? null;

    $this->_dirtyFields = [
      'concurrency' => true,
      'convai_concurrency' => true,
      'force_logging_disabled' => true,
      'can_request_manual_pro_voice_verification' => true,
      'can_bypass_voice_captcha' => true,
      'moderation' => true
    ];
    if (array_key_exists('enterpriseMusicConcurrency', $values)) {
      $this->_dirtyFields['enterprise_music_concurrency'] = true;
    }
    if (array_key_exists('musicFinetunesTotalLimit', $values)) {
      $this->_dirtyFields['music_finetunes_total_limit'] = true;
    }
    if (array_key_exists('musicFinetunesMonthlyLimit', $values)) {
      $this->_dirtyFields['music_finetunes_monthly_limit'] = true;
    }
    if (array_key_exists('musicFinetunesConcurrencyLimit', $values)) {
      $this->_dirtyFields['music_finetunes_concurrency_limit'] = true;
    }
    if (array_key_exists('convaiCharsPerMinute', $values)) {
      $this->_dirtyFields['convai_chars_per_minute'] = true;
    }
    if (array_key_exists('convaiAsrCharsPerMinute', $values)) {
      $this->_dirtyFields['convai_asr_chars_per_minute'] = true;
    }
    if (array_key_exists('unusedCharactersRolledOverFromPreviousPeriod', $values)) {
      $this->_dirtyFields['unused_characters_rolled_over_from_previous_period'] = true;
    }
    if (array_key_exists('overusedCharactersRolledOverFromPreviousPeriod', $values)) {
      $this->_dirtyFields['overused_characters_rolled_over_from_previous_period'] = true;
    }
    if (array_key_exists('usage', $values)) {
      $this->_dirtyFields['usage'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'concurrency',
      'contents' => (string) $this->concurrency
    ];

    $parts[] = [
      'name' => 'convai_concurrency',
      'contents' => (string) $this->convaiConcurrency
    ];

    if ($this->enterpriseMusicConcurrency !== null) {
      $parts[] = [
        'name' => 'enterprise_music_concurrency',
        'contents' => (string) $this->enterpriseMusicConcurrency
      ];
    }

    if ($this->musicFinetunesTotalLimit !== null) {
      $parts[] = [
        'name' => 'music_finetunes_total_limit',
        'contents' => (string) $this->musicFinetunesTotalLimit
      ];
    }

    if ($this->musicFinetunesMonthlyLimit !== null) {
      $parts[] = [
        'name' => 'music_finetunes_monthly_limit',
        'contents' => (string) $this->musicFinetunesMonthlyLimit
      ];
    }

    if ($this->musicFinetunesConcurrencyLimit !== null) {
      $parts[] = [
        'name' => 'music_finetunes_concurrency_limit',
        'contents' => (string) $this->musicFinetunesConcurrencyLimit
      ];
    }

    if ($this->convaiCharsPerMinute !== null) {
      $parts[] = [
        'name' => 'convai_chars_per_minute',
        'contents' => (string) $this->convaiCharsPerMinute
      ];
    }

    if ($this->convaiAsrCharsPerMinute !== null) {
      $parts[] = [
        'name' => 'convai_asr_chars_per_minute',
        'contents' => (string) $this->convaiAsrCharsPerMinute
      ];
    }

    $parts[] = [
      'name' => 'force_logging_disabled',
      'contents' => $this->forceLoggingDisabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'can_request_manual_pro_voice_verification',
      'contents' => $this->canRequestManualProVoiceVerification ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'can_bypass_voice_captcha',
      'contents' => $this->canBypassVoiceCaptcha ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'moderation',
      'contents' => json_encode($this->moderation),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->unusedCharactersRolledOverFromPreviousPeriod !== null) {
      $parts[] = [
        'name' => 'unused_characters_rolled_over_from_previous_period',
        'contents' => (string) $this->unusedCharactersRolledOverFromPreviousPeriod
      ];
    }

    if ($this->overusedCharactersRolledOverFromPreviousPeriod !== null) {
      $parts[] = [
        'name' => 'overused_characters_rolled_over_from_previous_period',
        'contents' => (string) $this->overusedCharactersRolledOverFromPreviousPeriod
      ];
    }

    if ($this->usage !== null) {
      $parts[] = [
        'name' => 'usage',
        'contents' => json_encode($this->usage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->moderation->validate();
    $this->usage?->validate();
  }
}
