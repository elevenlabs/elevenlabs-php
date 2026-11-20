<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A phone number held by the workspace.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionPhoneAssignment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Phone number in E.164 format.
   */
  #[JsonProperty('phone_number')]
  public ?string $phoneNumber;

  /**
   * True when the phone is bring-your-own: registered by the workspace using their own telephony provider (Twilio credentials or SIP trunk). BYO phones are never part of the shared pool, do not count against the plan's phone number limit, and are deleted (rather than returned to the pool) on release.
   */
  #[JsonProperty('is_byo')]
  public ?bool $isByo;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionPhoneProvider>
   * How calls to the number reach ElevenLabs: through Twilio or a SIP trunk.
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * US/Canada NANP area code (NPA) as an integer.
   */
  #[JsonProperty('nanp_area_code')]
  public ?int $nanpAreaCode;

  /**
   * The receptionist that answers this number. Null when the workspace holds the number but no receptionist answers it yet.
   */
  #[JsonProperty('customer_facing_agent_id')]
  public ?string $customerFacingAgentId;

  /**
   * Unix timestamp when this number was deactivated; it is released 14 days later. Null when active.
   */
  #[JsonProperty('deactivated_at_unix')]
  public ?int $deactivatedAtUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionPhoneAssignmentDeactivationReason>
   * Why this number was deactivated. Null when active.
   */
  #[JsonProperty('deactivation_reason')]
  public ?string $deactivationReason;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionPhoneRegulatoryStatus>
   * Null for numbers that need no paperwork. `held` while the workspace's own application is under review, `approved` once it passed and the number is fully usable.
   */
  #[JsonProperty('regulatory_status')]
  public ?string $regulatoryStatus;

  /**
   * @var ?value-of<\ElevenLabs\Types\ApplicationNumberType>
   * The regulated number type this number was issued as. Null for numbers that need no paperwork.
   */
  #[JsonProperty('regulatory_number_type')]
  public ?string $regulatoryNumberType;

  /**
   * ISO country the regulated number was issued in. Null for numbers that need no paperwork.
   */
  #[JsonProperty('regulatory_country')]
  public ?string $regulatoryCountry;

  /**
   * The phone number assignment's ID.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('created_at_unix')]
  public ?int $createdAtUnix;

  /**
   * Unix timestamp (seconds since epoch)
   */
  #[JsonProperty('updated_at_unix')]
  public ?int $updatedAtUnix;

  /**
   * Whether the number is active; false during the 14 days before a deactivated number is released.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * Whether inbound calls from the public may reach the receptionist.
   */
  #[JsonProperty('accepts_public_calls')]
  public ?bool $acceptsPublicCalls;

  /**
   * @param array{
   *   id: string,
   *   phoneNumber?: ?string,
   *   isByo?: ?bool,
   *   provider?: ?value-of<\ElevenLabs\Types\ReceptionPhoneProvider>,
   *   nanpAreaCode?: ?int,
   *   customerFacingAgentId?: ?string,
   *   deactivatedAtUnix?: ?int,
   *   deactivationReason?: ?value-of<\ElevenLabs\Types\ReceptionPhoneAssignmentDeactivationReason>,
   *   regulatoryStatus?: ?value-of<\ElevenLabs\Types\ReceptionPhoneRegulatoryStatus>,
   *   regulatoryNumberType?: ?value-of<\ElevenLabs\Types\ApplicationNumberType>,
   *   regulatoryCountry?: ?string,
   *   createdAtUnix?: ?int,
   *   updatedAtUnix?: ?int,
   *   isActive?: ?bool,
   *   acceptsPublicCalls?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumber = $values['phoneNumber'] ?? null;
    $this->isByo = $values['isByo'] ?? null;
    $this->provider = $values['provider'] ?? null;
    $this->nanpAreaCode = $values['nanpAreaCode'] ?? null;
    $this->customerFacingAgentId = $values['customerFacingAgentId'] ?? null;
    $this->deactivatedAtUnix = $values['deactivatedAtUnix'] ?? null;
    $this->deactivationReason = $values['deactivationReason'] ?? null;
    $this->regulatoryStatus = $values['regulatoryStatus'] ?? null;
    $this->regulatoryNumberType = $values['regulatoryNumberType'] ?? null;
    $this->regulatoryCountry = $values['regulatoryCountry'] ?? null;
    $this->id = $values['id'];
    $this->createdAtUnix = $values['createdAtUnix'] ?? null;
    $this->updatedAtUnix = $values['updatedAtUnix'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->acceptsPublicCalls = $values['acceptsPublicCalls'] ?? null;

    $this->_dirtyFields = [
      'id' => true
    ];
    if (array_key_exists('phoneNumber', $values)) {
      $this->_dirtyFields['phone_number'] = true;
    }
    if (array_key_exists('isByo', $values)) {
      $this->_dirtyFields['is_byo'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('nanpAreaCode', $values)) {
      $this->_dirtyFields['nanp_area_code'] = true;
    }
    if (array_key_exists('customerFacingAgentId', $values)) {
      $this->_dirtyFields['customer_facing_agent_id'] = true;
    }
    if (array_key_exists('deactivatedAtUnix', $values)) {
      $this->_dirtyFields['deactivated_at_unix'] = true;
    }
    if (array_key_exists('deactivationReason', $values)) {
      $this->_dirtyFields['deactivation_reason'] = true;
    }
    if (array_key_exists('regulatoryStatus', $values)) {
      $this->_dirtyFields['regulatory_status'] = true;
    }
    if (array_key_exists('regulatoryNumberType', $values)) {
      $this->_dirtyFields['regulatory_number_type'] = true;
    }
    if (array_key_exists('regulatoryCountry', $values)) {
      $this->_dirtyFields['regulatory_country'] = true;
    }
    if (array_key_exists('createdAtUnix', $values)) {
      $this->_dirtyFields['created_at_unix'] = true;
    }
    if (array_key_exists('updatedAtUnix', $values)) {
      $this->_dirtyFields['updated_at_unix'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
    if (array_key_exists('acceptsPublicCalls', $values)) {
      $this->_dirtyFields['accepts_public_calls'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->phoneNumber !== null) {
      $parts[] = [
        'name' => 'phone_number',
        'contents' => $this->phoneNumber
      ];
    }

    if ($this->isByo !== null) {
      $parts[] = [
        'name' => 'is_byo',
        'contents' => $this->isByo ? 'true' : 'false'
      ];
    }

    if ($this->provider !== null) {
      $parts[] = [
        'name' => 'provider',
        'contents' => $this->provider
      ];
    }

    if ($this->nanpAreaCode !== null) {
      $parts[] = [
        'name' => 'nanp_area_code',
        'contents' => (string) $this->nanpAreaCode
      ];
    }

    if ($this->customerFacingAgentId !== null) {
      $parts[] = [
        'name' => 'customer_facing_agent_id',
        'contents' => $this->customerFacingAgentId
      ];
    }

    if ($this->deactivatedAtUnix !== null) {
      $parts[] = [
        'name' => 'deactivated_at_unix',
        'contents' => (string) $this->deactivatedAtUnix
      ];
    }

    if ($this->deactivationReason !== null) {
      $parts[] = [
        'name' => 'deactivation_reason',
        'contents' => $this->deactivationReason
      ];
    }

    if ($this->regulatoryStatus !== null) {
      $parts[] = [
        'name' => 'regulatory_status',
        'contents' => $this->regulatoryStatus
      ];
    }

    if ($this->regulatoryNumberType !== null) {
      $parts[] = [
        'name' => 'regulatory_number_type',
        'contents' => $this->regulatoryNumberType
      ];
    }

    if ($this->regulatoryCountry !== null) {
      $parts[] = [
        'name' => 'regulatory_country',
        'contents' => $this->regulatoryCountry
      ];
    }

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->createdAtUnix !== null) {
      $parts[] = [
        'name' => 'created_at_unix',
        'contents' => (string) $this->createdAtUnix
      ];
    }

    if ($this->updatedAtUnix !== null) {
      $parts[] = [
        'name' => 'updated_at_unix',
        'contents' => (string) $this->updatedAtUnix
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    if ($this->acceptsPublicCalls !== null) {
      $parts[] = [
        'name' => 'accepts_public_calls',
        'contents' => $this->acceptsPublicCalls ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
