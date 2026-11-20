<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * A single business location stored inline in agent info.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionLocationInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('address')]
  public ?string $address;

  #[JsonProperty('notes')]
  public ?string $notes;

  #[JsonProperty('operating_hours')]
  public ?\ElevenLabs\Types\WorkingHours $operatingHours;

  #[JsonProperty('customer_facing_name')]
  public ?string $customerFacingName;

  /**
   * Maximum number of appointments that may overlap at this location at a single instant. Only enforced while the booking page setting concurrent_limit_enabled is on.
   */
  #[JsonProperty('max_concurrent_appointments')]
  public ?int $maxConcurrentAppointments;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Unix timestamp when this location was deactivated. None when active.
   */
  #[JsonProperty('deactivated_at_unix')]
  public ?int $deactivatedAtUnix;

  /**
   * @var ?value-of<\ElevenLabs\Types\ReceptionLocationDeactivationReason>
   * Why this location was deactivated. None when active.
   */
  #[JsonProperty('deactivation_reason')]
  public ?string $deactivationReason;

  /**
   * @param array{
   *   name: string,
   *   id: string,
   *   address?: ?string,
   *   notes?: ?string,
   *   operatingHours?: ?\ElevenLabs\Types\WorkingHours,
   *   customerFacingName?: ?string,
   *   maxConcurrentAppointments?: ?int,
   *   deactivatedAtUnix?: ?int,
   *   deactivationReason?: ?value-of<\ElevenLabs\Types\ReceptionLocationDeactivationReason>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->address = $values['address'] ?? null;
    $this->notes = $values['notes'] ?? null;
    $this->operatingHours = $values['operatingHours'] ?? null;
    $this->customerFacingName = $values['customerFacingName'] ?? null;
    $this->maxConcurrentAppointments = $values['maxConcurrentAppointments'] ?? null;
    $this->id = $values['id'];
    $this->deactivatedAtUnix = $values['deactivatedAtUnix'] ?? null;
    $this->deactivationReason = $values['deactivationReason'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'id' => true
    ];
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
    if (array_key_exists('deactivatedAtUnix', $values)) {
      $this->_dirtyFields['deactivated_at_unix'] = true;
    }
    if (array_key_exists('deactivationReason', $values)) {
      $this->_dirtyFields['deactivation_reason'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

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

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

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

    return $parts;
  }

  public function validate(): void
  {
    $this->operatingHours?->validate();
    Validator::validateNumber(
      $this->maxConcurrentAppointments,
      'max_concurrent_appointments',
      min: 1,
      max: 999
    );
  }
}
