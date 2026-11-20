<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A reseller-managed paid subscription, as the reseller can act on it.
 *
 * Present only for a workspace the reseller actually sells to: untiered and
 * trial workspaces have no subscription to change or end, and are assigned to
 * instead.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerWorkspaceSubscription extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tier_id', required: true)]
  public string $tierId;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResellerWorkspaceSubscriptionBillingPeriod>
   * Cadence being billed. None only for a subscription mid-provisioning.
   */
  #[JsonProperty('billing_period', required: true)]
  public ?string $billingPeriod;

  /**
   * When the current period ends, and so when a deferred change lands.
   */
  #[JsonProperty('billing_period_end_unix', required: true)]
  public int $billingPeriodEndUnix;

  /**
   * When the subscription ends. Set means a pending unassignment the reseller can still undo.
   */
  #[JsonProperty('cancel_at_unix')]
  public ?int $cancelAtUnix;

  /**
   * Tier this workspace drops to at the period boundary, if a downgrade is already scheduled.
   */
  #[JsonProperty('pending_downgrade_tier')]
  public ?string $pendingDowngradeTier;

  /**
   * When that scheduled downgrade takes effect.
   */
  #[JsonProperty('pending_downgrade_at_unix')]
  public ?int $pendingDowngradeAtUnix;

  /**
   * @param array{
   *   tierId: string,
   *   billingPeriod: ?value-of<\ElevenLabs\Types\ResellerWorkspaceSubscriptionBillingPeriod>,
   *   billingPeriodEndUnix: int,
   *   cancelAtUnix?: ?int,
   *   pendingDowngradeTier?: ?string,
   *   pendingDowngradeAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tierId = $values['tierId'];
    $this->billingPeriod = $values['billingPeriod'];
    $this->billingPeriodEndUnix = $values['billingPeriodEndUnix'];
    $this->cancelAtUnix = $values['cancelAtUnix'] ?? null;
    $this->pendingDowngradeTier = $values['pendingDowngradeTier'] ?? null;
    $this->pendingDowngradeAtUnix = $values['pendingDowngradeAtUnix'] ?? null;

    $this->_dirtyFields = [
      'tier_id' => true,
      'billing_period' => true,
      'billing_period_end_unix' => true
    ];
    if (array_key_exists('cancelAtUnix', $values)) {
      $this->_dirtyFields['cancel_at_unix'] = true;
    }
    if (array_key_exists('pendingDowngradeTier', $values)) {
      $this->_dirtyFields['pending_downgrade_tier'] = true;
    }
    if (array_key_exists('pendingDowngradeAtUnix', $values)) {
      $this->_dirtyFields['pending_downgrade_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tier_id',
      'contents' => $this->tierId
    ];

    $parts[] = [
      'name' => 'billing_period',
      'contents' => $this->billingPeriod
    ];

    $parts[] = [
      'name' => 'billing_period_end_unix',
      'contents' => (string) $this->billingPeriodEndUnix
    ];

    if ($this->cancelAtUnix !== null) {
      $parts[] = [
        'name' => 'cancel_at_unix',
        'contents' => (string) $this->cancelAtUnix
      ];
    }

    if ($this->pendingDowngradeTier !== null) {
      $parts[] = [
        'name' => 'pending_downgrade_tier',
        'contents' => $this->pendingDowngradeTier
      ];
    }

    if ($this->pendingDowngradeAtUnix !== null) {
      $parts[] = [
        'name' => 'pending_downgrade_at_unix',
        'contents' => (string) $this->pendingDowngradeAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
