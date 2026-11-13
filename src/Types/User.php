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
class User extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the user.
   */
  #[JsonProperty('user_id', required: true)]
  public string $userId;

  /**
   * The unique identifier of the workspace this user's API key belongs to.
   */
  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('subscription', required: true)]
  public \ElevenLabs\Types\SubscriptionResponse $subscription;

  /**
   * Whether the user is new. This field is deprecated and will be removed in the future. Use 'created_at' instead.
   */
  #[JsonProperty('is_new_user', required: true)]
  public bool $isNewUser;

  /**
   * This field is deprecated and will be removed in a future major version. Instead use subscription.trust_on_invoice_creation.
   */
  #[JsonProperty('can_use_delayed_payment_methods', required: true)]
  public bool $canUseDelayedPaymentMethods;

  /**
   * Whether the user's onboarding is completed.
   */
  #[JsonProperty('is_onboarding_completed', required: true)]
  public bool $isOnboardingCompleted;

  /**
   * Whether the user's onboarding checklist is completed.
   */
  #[JsonProperty('is_onboarding_checklist_completed', required: true)]
  public bool $isOnboardingChecklistCompleted;

  /**
   * Whether to show compliance terms (ToS, Privacy Policy, biometric consent) during onboarding. Set for users signing up from the marketing site.
   */
  #[JsonProperty('show_compliance_terms')]
  public ?bool $showComplianceTerms;

  /**
   * First name of the user.
   */
  #[JsonProperty('first_name')]
  public ?string $firstName;

  /**
   * Whether the user's API key is hashed.
   */
  #[JsonProperty('is_api_key_hashed')]
  public ?bool $isApiKeyHashed;

  /**
   * The preview of the user's API key.
   */
  #[JsonProperty('xi_api_key_preview')]
  public ?string $xiApiKeyPreview;

  /**
   * The referral link code of the user.
   */
  #[JsonProperty('referral_link_code')]
  public ?string $referralLinkCode;

  /**
   * The Partnerstack partner default link of the user.
   */
  #[JsonProperty('partnerstack_partner_default_link')]
  public ?string $partnerstackPartnerDefaultLink;

  /**
   * The unix timestamp of the user's creation. 0 if the user was created before the unix timestamp was added.
   */
  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  /**
   * @var value-of<\ElevenLabs\Types\SeatType>
   * Seat types for workspace members.
   */
  #[JsonProperty('seat_type', required: true)]
  public string $seatType;

  /**
   * @param array{
   *   userId: string,
   *   workspaceId: string,
   *   subscription: \ElevenLabs\Types\SubscriptionResponse,
   *   isNewUser: bool,
   *   canUseDelayedPaymentMethods: bool,
   *   isOnboardingCompleted: bool,
   *   isOnboardingChecklistCompleted: bool,
   *   createdAt: int,
   *   seatType: value-of<\ElevenLabs\Types\SeatType>,
   *   showComplianceTerms?: ?bool,
   *   firstName?: ?string,
   *   isApiKeyHashed?: ?bool,
   *   xiApiKeyPreview?: ?string,
   *   referralLinkCode?: ?string,
   *   partnerstackPartnerDefaultLink?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->workspaceId = $values['workspaceId'];
    $this->subscription = $values['subscription'];
    $this->isNewUser = $values['isNewUser'];
    $this->canUseDelayedPaymentMethods = $values['canUseDelayedPaymentMethods'];
    $this->isOnboardingCompleted = $values['isOnboardingCompleted'];
    $this->isOnboardingChecklistCompleted = $values['isOnboardingChecklistCompleted'];
    $this->showComplianceTerms = $values['showComplianceTerms'] ?? null;
    $this->firstName = $values['firstName'] ?? null;
    $this->isApiKeyHashed = $values['isApiKeyHashed'] ?? null;
    $this->xiApiKeyPreview = $values['xiApiKeyPreview'] ?? null;
    $this->referralLinkCode = $values['referralLinkCode'] ?? null;
    $this->partnerstackPartnerDefaultLink = $values['partnerstackPartnerDefaultLink'] ?? null;
    $this->createdAt = $values['createdAt'];
    $this->seatType = $values['seatType'];

    $this->_dirtyFields = [
      'user_id' => true,
      'workspace_id' => true,
      'subscription' => true,
      'is_new_user' => true,
      'can_use_delayed_payment_methods' => true,
      'is_onboarding_completed' => true,
      'is_onboarding_checklist_completed' => true,
      'created_at' => true,
      'seat_type' => true
    ];
    if (array_key_exists('showComplianceTerms', $values)) {
      $this->_dirtyFields['show_compliance_terms'] = true;
    }
    if (array_key_exists('firstName', $values)) {
      $this->_dirtyFields['first_name'] = true;
    }
    if (array_key_exists('isApiKeyHashed', $values)) {
      $this->_dirtyFields['is_api_key_hashed'] = true;
    }
    if (array_key_exists('xiApiKeyPreview', $values)) {
      $this->_dirtyFields['xi_api_key_preview'] = true;
    }
    if (array_key_exists('referralLinkCode', $values)) {
      $this->_dirtyFields['referral_link_code'] = true;
    }
    if (array_key_exists('partnerstackPartnerDefaultLink', $values)) {
      $this->_dirtyFields['partnerstack_partner_default_link'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'subscription',
      'contents' => json_encode($this->subscription),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'is_new_user',
      'contents' => $this->isNewUser ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'can_use_delayed_payment_methods',
      'contents' => $this->canUseDelayedPaymentMethods ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_onboarding_completed',
      'contents' => $this->isOnboardingCompleted ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_onboarding_checklist_completed',
      'contents' => $this->isOnboardingChecklistCompleted ? 'true' : 'false'
    ];

    if ($this->showComplianceTerms !== null) {
      $parts[] = [
        'name' => 'show_compliance_terms',
        'contents' => $this->showComplianceTerms ? 'true' : 'false'
      ];
    }

    if ($this->firstName !== null) {
      $parts[] = [
        'name' => 'first_name',
        'contents' => $this->firstName
      ];
    }

    if ($this->isApiKeyHashed !== null) {
      $parts[] = [
        'name' => 'is_api_key_hashed',
        'contents' => $this->isApiKeyHashed ? 'true' : 'false'
      ];
    }

    if ($this->xiApiKeyPreview !== null) {
      $parts[] = [
        'name' => 'xi_api_key_preview',
        'contents' => $this->xiApiKeyPreview
      ];
    }

    if ($this->referralLinkCode !== null) {
      $parts[] = [
        'name' => 'referral_link_code',
        'contents' => $this->referralLinkCode
      ];
    }

    if ($this->partnerstackPartnerDefaultLink !== null) {
      $parts[] = [
        'name' => 'partnerstack_partner_default_link',
        'contents' => $this->partnerstackPartnerDefaultLink
      ];
    }

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    $parts[] = [
      'name' => 'seat_type',
      'contents' => $this->seatType
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->subscription->validate();
  }
}
