<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Locations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionLocationRequestPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  #[JsonProperty('name')]
  public ?string $name;

  #[JsonProperty('address')]
  public ?string $address;

  #[JsonProperty('notes')]
  public ?string $notes;

  /**
   * Per-location operating hours. On create, omit to have the server prefill from the most recently added active location.
   */
  #[JsonProperty('operating_hours')]
  public ?\ElevenLabs\Types\WorkingHours $operatingHours;

  #[JsonProperty('customer_facing_name')]
  public ?string $customerFacingName;

  /**
   * Maximum number of appointments that may overlap at this location at a single instant. Only enforced while the booking page setting concurrent_limit_enabled is on.
   */
  #[JsonProperty('max_concurrent_appointments')]
  public ?int $maxConcurrentAppointments;

  /**
   * Whether the location is active. Inactive locations take no bookings.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   name?: ?string,
   *   address?: ?string,
   *   notes?: ?string,
   *   operatingHours?: ?\ElevenLabs\Types\WorkingHours,
   *   customerFacingName?: ?string,
   *   maxConcurrentAppointments?: ?int,
   *   isActive?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->name = $values['name'] ?? null;
    $this->address = $values['address'] ?? null;
    $this->notes = $values['notes'] ?? null;
    $this->operatingHours = $values['operatingHours'] ?? null;
    $this->customerFacingName = $values['customerFacingName'] ?? null;
    $this->maxConcurrentAppointments = $values['maxConcurrentAppointments'] ?? null;
    $this->isActive = $values['isActive'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('address', $values)) {
      $this->_dirtyFields['address'] = true;
    }
    if (array_key_exists('notes', $values)) {
      $this->_dirtyFields['notes'] = true;
    }
    if (array_key_exists('operatingHours', $values)) {
      $this->_dirtyFields['operating_hours'] = true;
    }
    if (array_key_exists('customerFacingName', $values)) {
      $this->_dirtyFields['customer_facing_name'] = true;
    }
    if (array_key_exists('maxConcurrentAppointments', $values)) {
      $this->_dirtyFields['max_concurrent_appointments'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->address !== null) {
      $parts[] = [
        'name' => 'address',
        'contents' => $this->address
      ];
    }

    if ($this->notes !== null) {
      $parts[] = [
        'name' => 'notes',
        'contents' => $this->notes
      ];
    }

    if ($this->operatingHours !== null) {
      $parts[] = [
        'name' => 'operating_hours',
        'contents' => json_encode($this->operatingHours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->customerFacingName !== null) {
      $parts[] = [
        'name' => 'customer_facing_name',
        'contents' => $this->customerFacingName
      ];
    }

    if ($this->maxConcurrentAppointments !== null) {
      $parts[] = [
        'name' => 'max_concurrent_appointments',
        'contents' => (string) $this->maxConcurrentAppointments
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->operatingHours?->validate();
  }
}
