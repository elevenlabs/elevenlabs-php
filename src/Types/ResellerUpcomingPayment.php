<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A workspace's next renewal, estimated before its invoice is created.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerUpcomingPayment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('workspace_name', required: true)]
  public string $workspaceName;

  /**
   * A reseller-managed paid subscription, as the reseller can act on it.
   *
   * Present only for a workspace the reseller actually sells to: untiered and
   * trial workspaces have no subscription to change or end, and are assigned to
   * instead.
   */
  #[JsonProperty('subscription', required: true)]
  public \ElevenLabs\Types\ResellerWorkspaceSubscription $subscription;

  /**
   * The plan the renewal charges upfront: the pending downgrade's tier when there is one.
   */
  #[JsonProperty('plan_usd', required: true)]
  public float $planUsd;

  /**
   * This period's usage beyond its included minutes so far, charged at the renewal and still growing.
   */
  #[JsonProperty('overage_so_far_usd', required: true)]
  public float $overageSoFarUsd;

  /**
   * @param array{
   *   workspaceId: string,
   *   workspaceName: string,
   *   subscription: \ElevenLabs\Types\ResellerWorkspaceSubscription,
   *   planUsd: float,
   *   overageSoFarUsd: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->workspaceId = $values['workspaceId'];
    $this->workspaceName = $values['workspaceName'];
    $this->subscription = $values['subscription'];
    $this->planUsd = $values['planUsd'];
    $this->overageSoFarUsd = $values['overageSoFarUsd'];

    $this->_dirtyFields = [
      'workspace_id' => true,
      'workspace_name' => true,
      'subscription' => true,
      'plan_usd' => true,
      'overage_so_far_usd' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'workspace_name',
      'contents' => $this->workspaceName
    ];

    $parts[] = [
      'name' => 'subscription',
      'contents' => json_encode($this->subscription),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'plan_usd',
      'contents' => (string) $this->planUsd
    ];

    $parts[] = [
      'name' => 'overage_so_far_usd',
      'contents' => (string) $this->overageSoFarUsd
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->subscription->validate();
  }
}
