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
class ResellerWorkspaceSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('business_name', required: true)]
  public string $businessName;

  #[JsonProperty('billing_tier', required: true)]
  public ?string $billingTier;

  #[JsonProperty('receptionist_count', required: true)]
  public int $receptionistCount;

  #[JsonProperty('calls_last_30_days', required: true)]
  public int $callsLast30Days;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * The reseller-managed subscription, when this workspace has one. None means nothing is sold here yet and a tier can be assigned.
   */
  #[JsonProperty('subscription')]
  public ?\ElevenLabs\Types\ResellerWorkspaceSubscription $subscription;

  /**
   * A charge for this workspace is unpaid. Assigning or changing a tier is refused until it clears, so surface it rather than letting it fail.
   */
  #[JsonProperty('has_payment_issue')]
  public ?bool $hasPaymentIssue;

  /**
   * When onboarding finished. Until then the onboarding wizard may replace or remove the workspace's business data.
   */
  #[JsonProperty('onboarding_completed_at_unix')]
  public ?int $onboardingCompletedAtUnix;

  /**
   * @param array{
   *   workspaceId: string,
   *   businessName: string,
   *   billingTier: ?string,
   *   receptionistCount: int,
   *   callsLast30Days: int,
   *   createdAtUnix: int,
   *   subscription?: ?\ElevenLabs\Types\ResellerWorkspaceSubscription,
   *   hasPaymentIssue?: ?bool,
   *   onboardingCompletedAtUnix?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->workspaceId = $values['workspaceId'];
    $this->businessName = $values['businessName'];
    $this->billingTier = $values['billingTier'];
    $this->receptionistCount = $values['receptionistCount'];
    $this->callsLast30Days = $values['callsLast30Days'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->subscription = $values['subscription'] ?? null;
    $this->hasPaymentIssue = $values['hasPaymentIssue'] ?? null;
    $this->onboardingCompletedAtUnix = $values['onboardingCompletedAtUnix'] ?? null;

    $this->_dirtyFields = [
      'workspace_id' => true,
      'business_name' => true,
      'billing_tier' => true,
      'receptionist_count' => true,
      'calls_last_30_days' => true,
      'created_at_unix' => true
    ];
    if (array_key_exists('subscription', $values)) {
      $this->_dirtyFields['subscription'] = true;
    }
    if (array_key_exists('hasPaymentIssue', $values)) {
      $this->_dirtyFields['has_payment_issue'] = true;
    }
    if (array_key_exists('onboardingCompletedAtUnix', $values)) {
      $this->_dirtyFields['onboarding_completed_at_unix'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'business_name',
      'contents' => $this->businessName
    ];

    $parts[] = [
      'name' => 'billing_tier',
      'contents' => $this->billingTier
    ];

    $parts[] = [
      'name' => 'receptionist_count',
      'contents' => (string) $this->receptionistCount
    ];

    $parts[] = [
      'name' => 'calls_last_30_days',
      'contents' => (string) $this->callsLast30Days
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    if ($this->subscription !== null) {
      $parts[] = [
        'name' => 'subscription',
        'contents' => json_encode($this->subscription),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->hasPaymentIssue !== null) {
      $parts[] = [
        'name' => 'has_payment_issue',
        'contents' => $this->hasPaymentIssue ? 'true' : 'false'
      ];
    }

    if ($this->onboardingCompletedAtUnix !== null) {
      $parts[] = [
        'name' => 'onboarding_completed_at_unix',
        'contents' => (string) $this->onboardingCompletedAtUnix
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->subscription?->validate();
  }
}
