<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Staff\Requests;

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
class ReceptionCreateStaffRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @var \ElevenLabs\Types\ReceptionGroupMembership[]|null
   * Group memberships for this item. Each entry carries the group label and the item's 0-based rank within that group.
   */
  #[JsonProperty('groups'), ArrayType([\ElevenLabs\Types\ReceptionGroupMembership::class])]
  public ?array $groups;

  /**
   * Display position among items with no group; `null` sorts last. Change it with the reorder endpoint.
   */
  #[JsonProperty('ungrouped_rank')]
  public ?int $ungroupedRank;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * Whether the staff member can be booked. Inactive staff keep their booking history.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * Email address of the staff member.
   */
  #[JsonProperty('email')]
  public ?string $email;

  #[JsonProperty('phone')]
  public ?string $phone;

  /**
   * Whether this staff member currently receives SMS booking notifications. Defaults to opted out — a staff member must be explicitly opted in; flipped to False automatically when they reply STOP to the workspace number.
   */
  #[JsonProperty('sms_notifications_opted_in')]
  public ?bool $smsNotificationsOptedIn;

  /**
   * URL of a photo of the staff member.
   */
  #[JsonProperty('photo_url')]
  public ?string $photoUrl;

  /**
   * Location this staff member is assigned to; empty means available at all locations.
   */
  #[JsonProperty('location_id')]
  public ?string $locationId;

  /**
   * Custom working hours for this staff member. Null means follow the assigned location's operating_hours (requires location_id).
   */
  #[JsonProperty('working_hours')]
  public ?\ElevenLabs\Types\WorkingHours $workingHours;

  /**
   * Whether customers can see and pick this staff member by name on the booking page. False keeps them bookable, just not shown by name.
   */
  #[JsonProperty('display_on_booking_page')]
  public ?bool $displayOnBookingPage;

  #[JsonProperty('customer_facing_name')]
  public ?string $customerFacingName;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   name: string,
   *   groups?: \ElevenLabs\Types\ReceptionGroupMembership[]|null,
   *   ungroupedRank?: ?int,
   *   description?: ?string,
   *   isActive?: ?bool,
   *   email?: ?string,
   *   phone?: ?string,
   *   smsNotificationsOptedIn?: ?bool,
   *   photoUrl?: ?string,
   *   locationId?: ?string,
   *   workingHours?: ?\ElevenLabs\Types\WorkingHours,
   *   displayOnBookingPage?: ?bool,
   *   customerFacingName?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->groups = $values['groups'] ?? null;
    $this->ungroupedRank = $values['ungroupedRank'] ?? null;
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->isActive = $values['isActive'] ?? null;
    $this->email = $values['email'] ?? null;
    $this->phone = $values['phone'] ?? null;
    $this->smsNotificationsOptedIn = $values['smsNotificationsOptedIn'] ?? null;
    $this->photoUrl = $values['photoUrl'] ?? null;
    $this->locationId = $values['locationId'] ?? null;
    $this->workingHours = $values['workingHours'] ?? null;
    $this->displayOnBookingPage = $values['displayOnBookingPage'] ?? null;
    $this->customerFacingName = $values['customerFacingName'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('groups', $values)) {
      $this->_dirtyFields['groups'] = true;
    }
    if (array_key_exists('ungroupedRank', $values)) {
      $this->_dirtyFields['ungrouped_rank'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
    if (array_key_exists('email', $values)) {
      $this->_dirtyFields['email'] = true;
    }
    if (array_key_exists('phone', $values)) {
      $this->_dirtyFields['phone'] = true;
    }
    if (array_key_exists('smsNotificationsOptedIn', $values)) {
      $this->_dirtyFields['sms_notifications_opted_in'] = true;
    }
    if (array_key_exists('photoUrl', $values)) {
      $this->_dirtyFields['photo_url'] = true;
    }
    if (array_key_exists('locationId', $values)) {
      $this->_dirtyFields['location_id'] = true;
    }
    if (array_key_exists('workingHours', $values)) {
      $this->_dirtyFields['working_hours'] = true;
    }
    if (array_key_exists('displayOnBookingPage', $values)) {
      $this->_dirtyFields['display_on_booking_page'] = true;
    }
    if (array_key_exists('customerFacingName', $values)) {
      $this->_dirtyFields['customer_facing_name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->groups !== null) {
      $parts[] = [
        'name' => 'groups',
        'contents' => json_encode($this->groups),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->ungroupedRank !== null) {
      $parts[] = [
        'name' => 'ungrouped_rank',
        'contents' => (string) $this->ungroupedRank
      ];
    }

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    if ($this->email !== null) {
      $parts[] = [
        'name' => 'email',
        'contents' => $this->email
      ];
    }

    if ($this->phone !== null) {
      $parts[] = [
        'name' => 'phone',
        'contents' => $this->phone
      ];
    }

    if ($this->smsNotificationsOptedIn !== null) {
      $parts[] = [
        'name' => 'sms_notifications_opted_in',
        'contents' => $this->smsNotificationsOptedIn ? 'true' : 'false'
      ];
    }

    if ($this->photoUrl !== null) {
      $parts[] = [
        'name' => 'photo_url',
        'contents' => $this->photoUrl
      ];
    }

    if ($this->locationId !== null) {
      $parts[] = [
        'name' => 'location_id',
        'contents' => $this->locationId
      ];
    }

    if ($this->workingHours !== null) {
      $parts[] = [
        'name' => 'working_hours',
        'contents' => json_encode($this->workingHours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->displayOnBookingPage !== null) {
      $parts[] = [
        'name' => 'display_on_booking_page',
        'contents' => $this->displayOnBookingPage ? 'true' : 'false'
      ];
    }

    if ($this->customerFacingName !== null) {
      $parts[] = [
        'name' => 'customer_facing_name',
        'contents' => $this->customerFacingName
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->groups ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->groups, 'groups', maxItems: 20);
    Validator::validateNumber($this->ungroupedRank, 'ungrouped_rank', min: 0);
    Validator::validateString($this->photoUrl, 'photo_url', minLength: 1, maxLength: 2083);
    $this->workingHours?->validate();
  }
}
