<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Subscription extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The tier of the user's subscription.
   */
  #[JsonProperty('tier', required: true)]
  public string $tier;

  /**
   * The number of characters used by the user.
   */
  #[JsonProperty('character_count', required: true)]
  public int $characterCount;

  /**
   * The maximum number of characters allowed in the current billing period.
   */
  #[JsonProperty('character_limit', required: true)]
  public int $characterLimit;

  /**
   * Deprecated: use `max_credit_limit_extension`. Maximum number of characters that the character limit can be exceeded by. Managed by the workspace admin.
   */
  #[JsonProperty('max_character_limit_extension', required: true)]
  public ?int $maxCharacterLimitExtension;

  /**
   * Maximum number of credits that the credit limit can be exceeded by. Managed by the workspace admin. `"unlimited"` means no cap, `0` means usage-based billing is disabled.
   */
  #[JsonProperty('max_credit_limit_extension', required: true), Union('integer', 'string')]
  public int|string $maxCreditLimitExtension;

  /**
   * Whether the workspace is entitled to enter overages (usage-based billing).
   */
  #[JsonProperty('can_extend_character_limit', required: true)]
  public bool $canExtendCharacterLimit;

  /**
   * Deprecated: use `max_credit_limit_extension != 0`. Whether the user is allowed to extend their character limit.
   */
  #[JsonProperty('allowed_to_extend_character_limit', required: true)]
  public bool $allowedToExtendCharacterLimit;

  /**
   * The Unix timestamp of the next character count reset.
   */
  #[JsonProperty('next_character_count_reset_unix')]
  public ?int $nextCharacterCountResetUnix;

  /**
   * The number of voice slots used by the user.
   */
  #[JsonProperty('voice_slots_used', required: true)]
  public int $voiceSlotsUsed;

  /**
   * The number of professional voice slots used. For consolidated billing this is the group-wide count across all workspaces in the group; see professional_voice_slots_used_in_workspace for the current workspace only.
   */
  #[JsonProperty('professional_voice_slots_used', required: true)]
  public int $professionalVoiceSlotsUsed;

  /**
   * The number of professional voice slots used in the current workspace. For consolidated billing, professional_voice_slots_used counts across all workspaces in the group, while this counts only the current workspace.
   */
  #[JsonProperty('professional_voice_slots_used_in_workspace', required: true)]
  public int $professionalVoiceSlotsUsedInWorkspace;

  /**
   * The maximum number of voice slots allowed for the user.
   */
  #[JsonProperty('voice_limit', required: true)]
  public int $voiceLimit;

  /**
   * The maximum number of voice add/edits allowed for the user.
   */
  #[JsonProperty('max_voice_add_edits')]
  public ?int $maxVoiceAddEdits;

  /**
   * The number of voice add/edits used by the user.
   */
  #[JsonProperty('voice_add_edit_counter', required: true)]
  public int $voiceAddEditCounter;

  /**
   * The maximum number of professional voices allowed for the user.
   */
  #[JsonProperty('professional_voice_limit', required: true)]
  public int $professionalVoiceLimit;

  /**
   * Whether the user can extend their voice limit.
   */
  #[JsonProperty('can_extend_voice_limit', required: true)]
  public bool $canExtendVoiceLimit;

  /**
   * Whether the user can use instant voice cloning.
   */
  #[JsonProperty('can_use_instant_voice_cloning', required: true)]
  public bool $canUseInstantVoiceCloning;

  /**
   * Whether the user can use professional voice cloning.
   */
  #[JsonProperty('can_use_professional_voice_cloning', required: true)]
  public bool $canUseProfessionalVoiceCloning;

  /**
   * @var ?value-of<\ElevenLabs\Types\Currency>
   * The currency of the user's subscription.
   */
  #[JsonProperty('currency')]
  public ?string $currency;

  /**
   * Currency/amount pair.
   */
  #[JsonProperty('current_overage', required: true)]
  public \ElevenLabs\Types\Price $currentOverage;

  /**
   * @var value-of<\ElevenLabs\Types\SubscriptionStatusType>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var ?value-of<\ElevenLabs\Types\BillingPeriod>
   * The billing period of the user's subscription.
   */
  #[JsonProperty('billing_period')]
  public ?string $billingPeriod;

  /**
   * @var ?value-of<\ElevenLabs\Types\CharacterRefreshPeriod>
   * The character refresh period of the user's subscription.
   */
  #[JsonProperty('character_refresh_period')]
  public ?string $characterRefreshPeriod;

  /**
   * The next invoice for the user.
   */
  #[JsonProperty('next_invoice')]
  public ?\ElevenLabs\Types\InvoiceResponse $nextInvoice;

  /**
   * @var \ElevenLabs\Types\InvoiceResponse[]
   * The open invoices for the user.
   */
  #[
    JsonProperty('open_invoices', required: true),
    ArrayType([\ElevenLabs\Types\InvoiceResponse::class])
  ]
  public array $openInvoices;

  /**
   * Whether the user has open invoices.
   */
  #[JsonProperty('has_open_invoices', required: true)]
  public bool $hasOpenInvoices;

  /**
   * Whether cancelling the subscription now ends it immediately, because an unpaid invoice is being collected, rather than at the end of the billing period.
   */
  #[JsonProperty('cancels_immediately')]
  public ?bool $cancelsImmediately;

  /**
   * The pending change for the user.
   */
  #[
    JsonProperty('pending_change'),
    Union(
      \ElevenLabs\Types\PendingSubscriptionSwitchResponseModel::class,
      \ElevenLabs\Types\PendingCancellationResponseModel::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\PendingSubscriptionSwitchResponseModel|\ElevenLabs\Types\PendingCancellationResponseModel|null $pendingChange;

  /**
   * True if any workspace owned by this user's auth account has redeemed the starter first-month discount coupon.
   */
  #[JsonProperty('has_used_starter_coupon_on_account')]
  public ?bool $hasUsedStarterCouponOnAccount;

  /**
   * True if any workspace owned by this user's auth account has redeemed the creator first-month discount coupon.
   */
  #[JsonProperty('has_used_creator_coupon_on_account')]
  public ?bool $hasUsedCreatorCouponOnAccount;

  /**
   * True if this user's auth account qualifies for the Starter first-month promo, using the same check as checkout. The starter_discount feature flag still decides whether the promo is offered.
   */
  #[JsonProperty('is_eligible_for_starter_promo')]
  public ?bool $isEligibleForStarterPromo;

  /**
   * @param array{
   *   tier: string,
   *   characterCount: int,
   *   characterLimit: int,
   *   maxCharacterLimitExtension: ?int,
   *   maxCreditLimitExtension: int|string,
   *   canExtendCharacterLimit: bool,
   *   allowedToExtendCharacterLimit: bool,
   *   voiceSlotsUsed: int,
   *   professionalVoiceSlotsUsed: int,
   *   professionalVoiceSlotsUsedInWorkspace: int,
   *   voiceLimit: int,
   *   voiceAddEditCounter: int,
   *   professionalVoiceLimit: int,
   *   canExtendVoiceLimit: bool,
   *   canUseInstantVoiceCloning: bool,
   *   canUseProfessionalVoiceCloning: bool,
   *   currentOverage: \ElevenLabs\Types\Price,
   *   status: value-of<\ElevenLabs\Types\SubscriptionStatusType>,
   *   openInvoices: \ElevenLabs\Types\InvoiceResponse[],
   *   hasOpenInvoices: bool,
   *   nextCharacterCountResetUnix?: ?int,
   *   maxVoiceAddEdits?: ?int,
   *   currency?: ?value-of<\ElevenLabs\Types\Currency>,
   *   billingPeriod?: ?value-of<\ElevenLabs\Types\BillingPeriod>,
   *   characterRefreshPeriod?: ?value-of<\ElevenLabs\Types\CharacterRefreshPeriod>,
   *   nextInvoice?: ?\ElevenLabs\Types\InvoiceResponse,
   *   cancelsImmediately?: ?bool,
   *   pendingChange?: \ElevenLabs\Types\PendingSubscriptionSwitchResponseModel|\ElevenLabs\Types\PendingCancellationResponseModel|null,
   *   hasUsedStarterCouponOnAccount?: ?bool,
   *   hasUsedCreatorCouponOnAccount?: ?bool,
   *   isEligibleForStarterPromo?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tier = $values['tier'];
    $this->characterCount = $values['characterCount'];
    $this->characterLimit = $values['characterLimit'];
    $this->maxCharacterLimitExtension = $values['maxCharacterLimitExtension'];
    $this->maxCreditLimitExtension = $values['maxCreditLimitExtension'];
    $this->canExtendCharacterLimit = $values['canExtendCharacterLimit'];
    $this->allowedToExtendCharacterLimit = $values['allowedToExtendCharacterLimit'];
    $this->nextCharacterCountResetUnix = $values['nextCharacterCountResetUnix'] ?? null;
    $this->voiceSlotsUsed = $values['voiceSlotsUsed'];
    $this->professionalVoiceSlotsUsed = $values['professionalVoiceSlotsUsed'];
    $this->professionalVoiceSlotsUsedInWorkspace = $values['professionalVoiceSlotsUsedInWorkspace'];
    $this->voiceLimit = $values['voiceLimit'];
    $this->maxVoiceAddEdits = $values['maxVoiceAddEdits'] ?? null;
    $this->voiceAddEditCounter = $values['voiceAddEditCounter'];
    $this->professionalVoiceLimit = $values['professionalVoiceLimit'];
    $this->canExtendVoiceLimit = $values['canExtendVoiceLimit'];
    $this->canUseInstantVoiceCloning = $values['canUseInstantVoiceCloning'];
    $this->canUseProfessionalVoiceCloning = $values['canUseProfessionalVoiceCloning'];
    $this->currency = $values['currency'] ?? null;
    $this->currentOverage = $values['currentOverage'];
    $this->status = $values['status'];
    $this->billingPeriod = $values['billingPeriod'] ?? null;
    $this->characterRefreshPeriod = $values['characterRefreshPeriod'] ?? null;
    $this->nextInvoice = $values['nextInvoice'] ?? null;
    $this->openInvoices = $values['openInvoices'];
    $this->hasOpenInvoices = $values['hasOpenInvoices'];
    $this->cancelsImmediately = $values['cancelsImmediately'] ?? null;
    $this->pendingChange = $values['pendingChange'] ?? null;
    $this->hasUsedStarterCouponOnAccount = $values['hasUsedStarterCouponOnAccount'] ?? null;
    $this->hasUsedCreatorCouponOnAccount = $values['hasUsedCreatorCouponOnAccount'] ?? null;
    $this->isEligibleForStarterPromo = $values['isEligibleForStarterPromo'] ?? null;

    $this->_dirtyFields = [
      'tier' => true,
      'character_count' => true,
      'character_limit' => true,
      'max_character_limit_extension' => true,
      'max_credit_limit_extension' => true,
      'can_extend_character_limit' => true,
      'allowed_to_extend_character_limit' => true,
      'voice_slots_used' => true,
      'professional_voice_slots_used' => true,
      'professional_voice_slots_used_in_workspace' => true,
      'voice_limit' => true,
      'voice_add_edit_counter' => true,
      'professional_voice_limit' => true,
      'can_extend_voice_limit' => true,
      'can_use_instant_voice_cloning' => true,
      'can_use_professional_voice_cloning' => true,
      'current_overage' => true,
      'status' => true,
      'open_invoices' => true,
      'has_open_invoices' => true
    ];
    if (array_key_exists('nextCharacterCountResetUnix', $values)) {
      $this->_dirtyFields['next_character_count_reset_unix'] = true;
    }
    if (array_key_exists('maxVoiceAddEdits', $values)) {
      $this->_dirtyFields['max_voice_add_edits'] = true;
    }
    if (array_key_exists('currency', $values)) {
      $this->_dirtyFields['currency'] = true;
    }
    if (array_key_exists('billingPeriod', $values)) {
      $this->_dirtyFields['billing_period'] = true;
    }
    if (array_key_exists('characterRefreshPeriod', $values)) {
      $this->_dirtyFields['character_refresh_period'] = true;
    }
    if (array_key_exists('nextInvoice', $values)) {
      $this->_dirtyFields['next_invoice'] = true;
    }
    if (array_key_exists('cancelsImmediately', $values)) {
      $this->_dirtyFields['cancels_immediately'] = true;
    }
    if (array_key_exists('pendingChange', $values)) {
      $this->_dirtyFields['pending_change'] = true;
    }
    if (array_key_exists('hasUsedStarterCouponOnAccount', $values)) {
      $this->_dirtyFields['has_used_starter_coupon_on_account'] = true;
    }
    if (array_key_exists('hasUsedCreatorCouponOnAccount', $values)) {
      $this->_dirtyFields['has_used_creator_coupon_on_account'] = true;
    }
    if (array_key_exists('isEligibleForStarterPromo', $values)) {
      $this->_dirtyFields['is_eligible_for_starter_promo'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tier',
      'contents' => $this->tier
    ];

    $parts[] = [
      'name' => 'character_count',
      'contents' => (string) $this->characterCount
    ];

    $parts[] = [
      'name' => 'character_limit',
      'contents' => (string) $this->characterLimit
    ];

    $parts[] = [
      'name' => 'max_character_limit_extension',
      'contents' => (string) $this->maxCharacterLimitExtension
    ];

    $parts[] = [
      'name' => 'max_credit_limit_extension',
      'contents' => json_encode($this->maxCreditLimitExtension),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'can_extend_character_limit',
      'contents' => $this->canExtendCharacterLimit ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'allowed_to_extend_character_limit',
      'contents' => $this->allowedToExtendCharacterLimit ? 'true' : 'false'
    ];

    if ($this->nextCharacterCountResetUnix !== null) {
      $parts[] = [
        'name' => 'next_character_count_reset_unix',
        'contents' => (string) $this->nextCharacterCountResetUnix
      ];
    }

    $parts[] = [
      'name' => 'voice_slots_used',
      'contents' => (string) $this->voiceSlotsUsed
    ];

    $parts[] = [
      'name' => 'professional_voice_slots_used',
      'contents' => (string) $this->professionalVoiceSlotsUsed
    ];

    $parts[] = [
      'name' => 'professional_voice_slots_used_in_workspace',
      'contents' => (string) $this->professionalVoiceSlotsUsedInWorkspace
    ];

    $parts[] = [
      'name' => 'voice_limit',
      'contents' => (string) $this->voiceLimit
    ];

    if ($this->maxVoiceAddEdits !== null) {
      $parts[] = [
        'name' => 'max_voice_add_edits',
        'contents' => (string) $this->maxVoiceAddEdits
      ];
    }

    $parts[] = [
      'name' => 'voice_add_edit_counter',
      'contents' => (string) $this->voiceAddEditCounter
    ];

    $parts[] = [
      'name' => 'professional_voice_limit',
      'contents' => (string) $this->professionalVoiceLimit
    ];

    $parts[] = [
      'name' => 'can_extend_voice_limit',
      'contents' => $this->canExtendVoiceLimit ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'can_use_instant_voice_cloning',
      'contents' => $this->canUseInstantVoiceCloning ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'can_use_professional_voice_cloning',
      'contents' => $this->canUseProfessionalVoiceCloning ? 'true' : 'false'
    ];

    if ($this->currency !== null) {
      $parts[] = [
        'name' => 'currency',
        'contents' => $this->currency
      ];
    }

    $parts[] = [
      'name' => 'current_overage',
      'contents' => json_encode($this->currentOverage),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->billingPeriod !== null) {
      $parts[] = [
        'name' => 'billing_period',
        'contents' => $this->billingPeriod
      ];
    }

    if ($this->characterRefreshPeriod !== null) {
      $parts[] = [
        'name' => 'character_refresh_period',
        'contents' => $this->characterRefreshPeriod
      ];
    }

    if ($this->nextInvoice !== null) {
      $parts[] = [
        'name' => 'next_invoice',
        'contents' => json_encode($this->nextInvoice),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'open_invoices',
      'contents' => json_encode($this->openInvoices),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'has_open_invoices',
      'contents' => $this->hasOpenInvoices ? 'true' : 'false'
    ];

    if ($this->cancelsImmediately !== null) {
      $parts[] = [
        'name' => 'cancels_immediately',
        'contents' => $this->cancelsImmediately ? 'true' : 'false'
      ];
    }

    if ($this->pendingChange !== null) {
      $parts[] = [
        'name' => 'pending_change',
        'contents' => json_encode($this->pendingChange),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->hasUsedStarterCouponOnAccount !== null) {
      $parts[] = [
        'name' => 'has_used_starter_coupon_on_account',
        'contents' => $this->hasUsedStarterCouponOnAccount ? 'true' : 'false'
      ];
    }

    if ($this->hasUsedCreatorCouponOnAccount !== null) {
      $parts[] = [
        'name' => 'has_used_creator_coupon_on_account',
        'contents' => $this->hasUsedCreatorCouponOnAccount ? 'true' : 'false'
      ];
    }

    if ($this->isEligibleForStarterPromo !== null) {
      $parts[] = [
        'name' => 'is_eligible_for_starter_promo',
        'contents' => $this->isEligibleForStarterPromo ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->currentOverage->validate();
    $this->nextInvoice?->validate();
    foreach ($this->openInvoices as $item) {
      $item->validate();
    }
  }
}
