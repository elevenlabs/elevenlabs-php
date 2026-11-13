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
class SubscriptionUsageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The rollover credits quota.
   */
  #[JsonProperty('rollover_credits_quota', required: true)]
  public int $rolloverCreditsQuota;

  /**
   * The subscription cycle credits quota.
   */
  #[JsonProperty('subscription_cycle_credits_quota', required: true)]
  public int $subscriptionCycleCreditsQuota;

  /**
   * The manually gifted credits quota.
   */
  #[JsonProperty('manually_gifted_credits_quota', required: true)]
  public int $manuallyGiftedCreditsQuota;

  /**
   * The payg credits quota.
   */
  #[JsonProperty('payg_credits_quota')]
  public ?int $paygCreditsQuota;

  /**
   * The rollover credits used.
   */
  #[JsonProperty('rollover_credits_used', required: true)]
  public int $rolloverCreditsUsed;

  /**
   * The subscription cycle credits used.
   */
  #[JsonProperty('subscription_cycle_credits_used', required: true)]
  public int $subscriptionCycleCreditsUsed;

  /**
   * The manually gifted credits used.
   */
  #[JsonProperty('manually_gifted_credits_used', required: true)]
  public int $manuallyGiftedCreditsUsed;

  /**
   * The payg credits used.
   */
  #[JsonProperty('payg_credits_used')]
  public ?int $paygCreditsUsed;

  /**
   * The paid usage based credits used.
   */
  #[JsonProperty('paid_usage_based_credits_used', required: true)]
  public int $paidUsageBasedCreditsUsed;

  /**
   * The actual reported credits.
   */
  #[JsonProperty('actual_reported_credits', required: true)]
  public int $actualReportedCredits;

  /**
   * @param array{
   *   rolloverCreditsQuota: int,
   *   subscriptionCycleCreditsQuota: int,
   *   manuallyGiftedCreditsQuota: int,
   *   rolloverCreditsUsed: int,
   *   subscriptionCycleCreditsUsed: int,
   *   manuallyGiftedCreditsUsed: int,
   *   paidUsageBasedCreditsUsed: int,
   *   actualReportedCredits: int,
   *   paygCreditsQuota?: ?int,
   *   paygCreditsUsed?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->rolloverCreditsQuota = $values['rolloverCreditsQuota'];
    $this->subscriptionCycleCreditsQuota = $values['subscriptionCycleCreditsQuota'];
    $this->manuallyGiftedCreditsQuota = $values['manuallyGiftedCreditsQuota'];
    $this->paygCreditsQuota = $values['paygCreditsQuota'] ?? null;
    $this->rolloverCreditsUsed = $values['rolloverCreditsUsed'];
    $this->subscriptionCycleCreditsUsed = $values['subscriptionCycleCreditsUsed'];
    $this->manuallyGiftedCreditsUsed = $values['manuallyGiftedCreditsUsed'];
    $this->paygCreditsUsed = $values['paygCreditsUsed'] ?? null;
    $this->paidUsageBasedCreditsUsed = $values['paidUsageBasedCreditsUsed'];
    $this->actualReportedCredits = $values['actualReportedCredits'];

    $this->_dirtyFields = [
      'rollover_credits_quota' => true,
      'subscription_cycle_credits_quota' => true,
      'manually_gifted_credits_quota' => true,
      'rollover_credits_used' => true,
      'subscription_cycle_credits_used' => true,
      'manually_gifted_credits_used' => true,
      'paid_usage_based_credits_used' => true,
      'actual_reported_credits' => true
    ];
    if (array_key_exists('paygCreditsQuota', $values)) {
      $this->_dirtyFields['payg_credits_quota'] = true;
    }
    if (array_key_exists('paygCreditsUsed', $values)) {
      $this->_dirtyFields['payg_credits_used'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'rollover_credits_quota',
      'contents' => (string) $this->rolloverCreditsQuota
    ];

    $parts[] = [
      'name' => 'subscription_cycle_credits_quota',
      'contents' => (string) $this->subscriptionCycleCreditsQuota
    ];

    $parts[] = [
      'name' => 'manually_gifted_credits_quota',
      'contents' => (string) $this->manuallyGiftedCreditsQuota
    ];

    if ($this->paygCreditsQuota !== null) {
      $parts[] = [
        'name' => 'payg_credits_quota',
        'contents' => (string) $this->paygCreditsQuota
      ];
    }

    $parts[] = [
      'name' => 'rollover_credits_used',
      'contents' => (string) $this->rolloverCreditsUsed
    ];

    $parts[] = [
      'name' => 'subscription_cycle_credits_used',
      'contents' => (string) $this->subscriptionCycleCreditsUsed
    ];

    $parts[] = [
      'name' => 'manually_gifted_credits_used',
      'contents' => (string) $this->manuallyGiftedCreditsUsed
    ];

    if ($this->paygCreditsUsed !== null) {
      $parts[] = [
        'name' => 'payg_credits_used',
        'contents' => (string) $this->paygCreditsUsed
      ];
    }

    $parts[] = [
      'name' => 'paid_usage_based_credits_used',
      'contents' => (string) $this->paidUsageBasedCreditsUsed
    ];

    $parts[] = [
      'name' => 'actual_reported_credits',
      'contents' => (string) $this->actualReportedCredits
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
