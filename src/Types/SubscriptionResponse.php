<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubscriptionResponse extends JsonSerializableType
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
   *   nextCharacterCountResetUnix?: ?int,
   *   maxVoiceAddEdits?: ?int,
   *   currency?: ?value-of<\ElevenLabs\Types\Currency>,
   *   billingPeriod?: ?value-of<\ElevenLabs\Types\BillingPeriod>,
   *   characterRefreshPeriod?: ?value-of<\ElevenLabs\Types\CharacterRefreshPeriod>,
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
      'status' => true
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

    return $parts;
  }

  public function validate(): void
  {
    $this->currentOverage->validate();
  }
}
