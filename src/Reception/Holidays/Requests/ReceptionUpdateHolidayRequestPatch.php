<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Holidays\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionUpdateHolidayRequestPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * Display name of the closure or time off.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * Represents a calendar date as individual numeric components.
   */
  #[JsonProperty('start_date')]
  public ?\ElevenLabs\Types\DateModel $startDate;

  /**
   * Represents a calendar date as individual numeric components.
   */
  #[JsonProperty('end_date')]
  public ?\ElevenLabs\Types\DateModel $endDate;

  /**
   * @var ?value-of<\ElevenLabs\Types\HolidayType>
   * Whether the entry closes the target for the whole range or replaces its working hours.
   */
  #[JsonProperty('holiday_type')]
  public ?string $holidayType;

  /**
   * @var \ElevenLabs\Types\TimeRangeModel[]|null
   * Replacement working hours when holiday_type is 'override'.
   */
  #[JsonProperty('override_hours'), ArrayType([\ElevenLabs\Types\TimeRangeModel::class])]
  public ?array $overrideHours;

  /**
   * @var ?value-of<\ElevenLabs\Types\TimeOffType>
   * What a time-off entry blocks: a staff member, an asset, or a location.
   */
  #[JsonProperty('time_off_type')]
  public ?string $timeOffType;

  /**
   * The staff member or asset ID; required when time_off_type is 'staff' or 'asset'.
   */
  #[JsonProperty('resource_id')]
  public ?string $resourceId;

  /**
   * For LOCATION type: the location this closure applies to.
   */
  #[JsonProperty('location_id')]
  public ?string $locationId;

  /**
   * Optional note on why the closure or time off happens, up to 500 characters.
   */
  #[JsonProperty('reason')]
  public ?string $reason;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   name?: ?string,
   *   startDate?: ?\ElevenLabs\Types\DateModel,
   *   endDate?: ?\ElevenLabs\Types\DateModel,
   *   holidayType?: ?value-of<\ElevenLabs\Types\HolidayType>,
   *   overrideHours?: \ElevenLabs\Types\TimeRangeModel[]|null,
   *   timeOffType?: ?value-of<\ElevenLabs\Types\TimeOffType>,
   *   resourceId?: ?string,
   *   locationId?: ?string,
   *   reason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->name = $values['name'] ?? null;
    $this->startDate = $values['startDate'] ?? null;
    $this->endDate = $values['endDate'] ?? null;
    $this->holidayType = $values['holidayType'] ?? null;
    $this->overrideHours = $values['overrideHours'] ?? null;
    $this->timeOffType = $values['timeOffType'] ?? null;
    $this->resourceId = $values['resourceId'] ?? null;
    $this->locationId = $values['locationId'] ?? null;
    $this->reason = $values['reason'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('startDate', $values)) {
      $this->_dirtyFields['start_date'] = true;
    }
    if (array_key_exists('endDate', $values)) {
      $this->_dirtyFields['end_date'] = true;
    }
    if (array_key_exists('holidayType', $values)) {
      $this->_dirtyFields['holiday_type'] = true;
    }
    if (array_key_exists('overrideHours', $values)) {
      $this->_dirtyFields['override_hours'] = true;
    }
    if (array_key_exists('timeOffType', $values)) {
      $this->_dirtyFields['time_off_type'] = true;
    }
    if (array_key_exists('resourceId', $values)) {
      $this->_dirtyFields['resource_id'] = true;
    }
    if (array_key_exists('locationId', $values)) {
      $this->_dirtyFields['location_id'] = true;
    }
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
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

    if ($this->startDate !== null) {
      $parts[] = [
        'name' => 'start_date',
        'contents' => json_encode($this->startDate),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->endDate !== null) {
      $parts[] = [
        'name' => 'end_date',
        'contents' => json_encode($this->endDate),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->holidayType !== null) {
      $parts[] = [
        'name' => 'holiday_type',
        'contents' => $this->holidayType
      ];
    }

    if ($this->overrideHours !== null) {
      $parts[] = [
        'name' => 'override_hours',
        'contents' => json_encode($this->overrideHours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->timeOffType !== null) {
      $parts[] = [
        'name' => 'time_off_type',
        'contents' => $this->timeOffType
      ];
    }

    if ($this->resourceId !== null) {
      $parts[] = [
        'name' => 'resource_id',
        'contents' => $this->resourceId
      ];
    }

    if ($this->locationId !== null) {
      $parts[] = [
        'name' => 'location_id',
        'contents' => $this->locationId
      ];
    }

    if ($this->reason !== null) {
      $parts[] = [
        'name' => 'reason',
        'contents' => $this->reason
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->startDate?->validate();
    $this->endDate?->validate();
    foreach ($this->overrideHours ?? [] as $item) {
      $item->validate();
    }
  }
}
