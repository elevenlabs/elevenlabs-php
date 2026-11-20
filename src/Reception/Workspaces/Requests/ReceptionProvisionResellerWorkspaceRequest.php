<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Workspaces\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionProvisionResellerWorkspaceRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('business_name', required: true)]
  public string $businessName;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionVertical>
   * The business's vertical, used with `complete_onboarding`. Without it, onboarding picks the vertical as usual.
   */
  #[JsonProperty('vertical')]
  public ?string $vertical;

  /**
   * Paid tier to subscribe to. Omitted leaves the workspace with no subscription.
   */
  #[JsonProperty('subscription')]
  public ?\ElevenLabs\Types\ProvisionResellerWorkspaceSubscription $subscription;

  /**
   * A free number from the reseller's phone pool, reserved for the workspace until onboarding binds it to the receptionist.
   */
  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  /**
   * @var \ElevenLabs\Types\TeamInviteRequest[]|null
   * People to invite once the workspace exists, capped by the tier's team size. Best-effort: each outcome is in `member_results`.
   */
  #[JsonProperty('members'), ArrayType([\ElevenLabs\Types\TeamInviteRequest::class])]
  public ?array $members;

  /**
   * Finish setup right away, as `POST /v1/reception/reseller/workspaces/{workspace_id}/complete-onboarding` does. Best-effort: `onboarding_completed_at_unix` stays null on failure, and that call can be retried.
   */
  #[JsonProperty('complete_onboarding')]
  public ?bool $completeOnboarding;

  /**
   * Client-generated key that makes a retry safe. The same key and body within 24 hours returns the first result without running again. While that first request is still running, a retry gets 409 `idempotency_key_in_progress`; a different body with the same key gets 400 `idempotency_key_reused`. A request that fails is not saved, so it can be retried with the same key.
   */
  #[JsonProperty('idempotency_key')]
  public ?string $idempotencyKey;

  /**
   * @param array{
   *   businessName: string,
   *   vertical?: ?value-of<\ElevenLabs\Types\ReceptionVertical>,
   *   subscription?: ?\ElevenLabs\Types\ProvisionResellerWorkspaceSubscription,
   *   phoneNumber?: ?string,
   *   members?: \ElevenLabs\Types\TeamInviteRequest[]|null,
   *   completeOnboarding?: ?bool,
   *   idempotencyKey?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->businessName = $values['businessName'];
    $this->vertical = $values['vertical'] ?? null;
    $this->subscription = $values['subscription'] ?? null;
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->members = $values['members'] ?? null;
    $this->completeOnboarding = $values['completeOnboarding'] ?? null;
    $this->idempotencyKey = $values['idempotencyKey'] ?? null;

    $this->_dirtyFields = [
      'business_name' => true
    ];
    if (array_key_exists('vertical', $values)) {
      $this->_dirtyFields['vertical'] = true;
    }
    if (array_key_exists('subscription', $values)) {
      $this->_dirtyFields['subscription'] = true;
    }
    if (array_key_exists('phoneNumber', $values)) {
      $this->_dirtyFields['phone_number'] = true;
    }
    if (array_key_exists('members', $values)) {
      $this->_dirtyFields['members'] = true;
    }
    if (array_key_exists('completeOnboarding', $values)) {
      $this->_dirtyFields['complete_onboarding'] = true;
    }
    if (array_key_exists('idempotencyKey', $values)) {
      $this->_dirtyFields['idempotency_key'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'business_name',
      'contents' => $this->businessName
    ];

    if ($this->vertical !== null) {
      $parts[] = [
        'name' => 'vertical',
        'contents' => $this->vertical
      ];
    }

    if ($this->subscription !== null) {
      $parts[] = [
        'name' => 'subscription',
        'contents' => json_encode($this->subscription),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneNumber !== null) {
      $parts[] = [
        'name' => 'phone_number',
        'contents' => $this->phoneNumber
      ];
    }

    if ($this->members !== null) {
      $parts[] = [
        'name' => 'members',
        'contents' => json_encode($this->members),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->completeOnboarding !== null) {
      $parts[] = [
        'name' => 'complete_onboarding',
        'contents' => $this->completeOnboarding ? 'true' : 'false'
      ];
    }

    if ($this->idempotencyKey !== null) {
      $parts[] = [
        'name' => 'idempotency_key',
        'contents' => $this->idempotencyKey
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->businessName, 'business_name', minLength: 1, maxLength: 100);
    $this->subscription?->validate();
    foreach ($this->members ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->members, 'members', maxItems: 100);
    Validator::validateString($this->idempotencyKey, 'idempotency_key', maxLength: 255);
  }
}
