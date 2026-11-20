<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Assets\Requests;

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
class ReceptionCreateAssetRequest extends JsonSerializableType
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
   * Whether the asset can be booked. Inactive assets keep their booking history.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * Custom availability hours for this asset. Null means follow the assigned location's operating_hours (requires location_id).
   */
  #[JsonProperty('available_hours')]
  public ?\ElevenLabs\Types\WorkingHours $availableHours;

  /**
   * URL of a photo of the asset.
   */
  #[JsonProperty('photo_url')]
  public ?string $photoUrl;

  /**
   * Location this asset belongs to; empty means available at all locations.
   */
  #[JsonProperty('location_id')]
  public ?string $locationId;

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
   *   availableHours?: ?\ElevenLabs\Types\WorkingHours,
   *   photoUrl?: ?string,
   *   locationId?: ?string,
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
    $this->availableHours = $values['availableHours'] ?? null;
    $this->photoUrl = $values['photoUrl'] ?? null;
    $this->locationId = $values['locationId'] ?? null;
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
    if (array_key_exists('availableHours', $values)) {
      $this->_dirtyFields['available_hours'] = true;
    }
    if (array_key_exists('photoUrl', $values)) {
      $this->_dirtyFields['photo_url'] = true;
    }
    if (array_key_exists('locationId', $values)) {
      $this->_dirtyFields['location_id'] = true;
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

    if ($this->availableHours !== null) {
      $parts[] = [
        'name' => 'available_hours',
        'contents' => json_encode($this->availableHours),
        'headers' => ['Content-Type' => 'application/json']
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
    $this->availableHours?->validate();
    Validator::validateString($this->photoUrl, 'photo_url', minLength: 1, maxLength: 2083);
  }
}
