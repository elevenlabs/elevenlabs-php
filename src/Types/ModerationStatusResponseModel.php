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
class ModerationStatusResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the user is in probation.
   */
  #[JsonProperty('is_in_probation', required: true)]
  public bool $isInProbation;

  /**
   * Whether the user's enterprise check nogo voice is enabled.
   */
  #[JsonProperty('enterprise_check_nogo_voice', required: true)]
  public bool $enterpriseCheckNogoVoice;

  /**
   * Whether the user's enterprise check block nogo voice is enabled.
   */
  #[JsonProperty('enterprise_check_block_nogo_voice', required: true)]
  public bool $enterpriseCheckBlockNogoVoice;

  /**
   * Whether the user's never live moderate is enabled.
   */
  #[JsonProperty('never_live_moderate', required: true)]
  public bool $neverLiveModerate;

  /**
   * The number of similar voice uploads that have been blocked.
   */
  #[JsonProperty('nogo_voice_similar_voice_upload_count', required: true)]
  public int $nogoVoiceSimilarVoiceUploadCount;

  /**
   * Whether the user's enterprise background moderation is enabled.
   */
  #[JsonProperty('enterprise_background_moderation_enabled', required: true)]
  public bool $enterpriseBackgroundModerationEnabled;

  /**
   * Whether captcha is required when creating IVCs.
   */
  #[JsonProperty('is_ivc_captcha_required', required: true)]
  public bool $isIvcCaptchaRequired;

  /**
   * @var ?value-of<\ElevenLabs\Types\ModerationStatusResponseModelSafetyStatus>
   * The safety status of the user.
   */
  #[JsonProperty('safety_status')]
  public ?string $safetyStatus;

  /**
   * @var ?value-of<\ElevenLabs\Types\ModerationStatusResponseModelWarningStatus>
   * The warning status of the user.
   */
  #[JsonProperty('warning_status')]
  public ?string $warningStatus;

  /**
   * Whether the user is on the watchlist.
   */
  #[JsonProperty('on_watchlist', required: true)]
  public bool $onWatchlist;

  /**
   * @param array{
   *   isInProbation: bool,
   *   enterpriseCheckNogoVoice: bool,
   *   enterpriseCheckBlockNogoVoice: bool,
   *   neverLiveModerate: bool,
   *   nogoVoiceSimilarVoiceUploadCount: int,
   *   enterpriseBackgroundModerationEnabled: bool,
   *   isIvcCaptchaRequired: bool,
   *   onWatchlist: bool,
   *   safetyStatus?: ?value-of<\ElevenLabs\Types\ModerationStatusResponseModelSafetyStatus>,
   *   warningStatus?: ?value-of<\ElevenLabs\Types\ModerationStatusResponseModelWarningStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isInProbation = $values['isInProbation'];
    $this->enterpriseCheckNogoVoice = $values['enterpriseCheckNogoVoice'];
    $this->enterpriseCheckBlockNogoVoice = $values['enterpriseCheckBlockNogoVoice'];
    $this->neverLiveModerate = $values['neverLiveModerate'];
    $this->nogoVoiceSimilarVoiceUploadCount = $values['nogoVoiceSimilarVoiceUploadCount'];
    $this->enterpriseBackgroundModerationEnabled = $values['enterpriseBackgroundModerationEnabled'];
    $this->isIvcCaptchaRequired = $values['isIvcCaptchaRequired'];
    $this->safetyStatus = $values['safetyStatus'] ?? null;
    $this->warningStatus = $values['warningStatus'] ?? null;
    $this->onWatchlist = $values['onWatchlist'];

    $this->_dirtyFields = [
      'is_in_probation' => true,
      'enterprise_check_nogo_voice' => true,
      'enterprise_check_block_nogo_voice' => true,
      'never_live_moderate' => true,
      'nogo_voice_similar_voice_upload_count' => true,
      'enterprise_background_moderation_enabled' => true,
      'is_ivc_captcha_required' => true,
      'on_watchlist' => true
    ];
    if (array_key_exists('safetyStatus', $values)) {
      $this->_dirtyFields['safety_status'] = true;
    }
    if (array_key_exists('warningStatus', $values)) {
      $this->_dirtyFields['warning_status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'is_in_probation',
      'contents' => $this->isInProbation ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'enterprise_check_nogo_voice',
      'contents' => $this->enterpriseCheckNogoVoice ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'enterprise_check_block_nogo_voice',
      'contents' => $this->enterpriseCheckBlockNogoVoice ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'never_live_moderate',
      'contents' => $this->neverLiveModerate ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'nogo_voice_similar_voice_upload_count',
      'contents' => (string) $this->nogoVoiceSimilarVoiceUploadCount
    ];

    $parts[] = [
      'name' => 'enterprise_background_moderation_enabled',
      'contents' => $this->enterpriseBackgroundModerationEnabled ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_ivc_captcha_required',
      'contents' => $this->isIvcCaptchaRequired ? 'true' : 'false'
    ];

    if ($this->safetyStatus !== null) {
      $parts[] = [
        'name' => 'safety_status',
        'contents' => $this->safetyStatus
      ];
    }

    if ($this->warningStatus !== null) {
      $parts[] = [
        'name' => 'warning_status',
        'contents' => $this->warningStatus
      ];
    }

    $parts[] = [
      'name' => 'on_watchlist',
      'contents' => $this->onWatchlist ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
