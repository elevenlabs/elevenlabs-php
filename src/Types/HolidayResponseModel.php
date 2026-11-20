<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A closure or time-off entry.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class HolidayResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Display name of the closure or time off.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Represents a calendar date as individual numeric components.
   */
  #[JsonProperty('start_date', required: true)]
  public \ElevenLabs\Types\DateModel $startDate;

  /**
   * Represents a calendar date as individual numeric components.
   */
  #[JsonProperty('end_date', required: true)]
  public \ElevenLabs\Types\DateModel $endDate;

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
   * @var value-of<\ElevenLabs\Types\TimeOffType>
   * What a time-off entry blocks: a staff member, an asset, or a location.
   */
  #[JsonProperty('time_off_type', required: true)]
  public string $timeOffType;

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
   * The closure or time-off entry's ID.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * When the entry was created, as a Unix timestamp in seconds.
   */
  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  /**
   * When the entry was last updated, as a Unix timestamp in seconds.
   */
  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  /**
   * @param array{
   *   name: string,
   *   startDate: \ElevenLabs\Types\DateModel,
   *   endDate: \ElevenLabs\Types\DateModel,
   *   timeOffType: value-of<\ElevenLabs\Types\TimeOffType>,
   *   id: string,
   *   createdAtUnix: int,
   *   updatedAtUnix: int,
   *   holidayType?: ?value-of<\ElevenLabs\Types\HolidayType>,
   *   overrideHours?: \ElevenLabs\Types\TimeRangeModel[]|null,
   *   resourceId?: ?string,
   *   locationId?: ?string,
   *   reason?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->startDate = $values['startDate'];
    $this->endDate = $values['endDate'];
    $this->holidayType = $values['holidayType'] ?? null;
    $this->overrideHours = $values['overrideHours'] ?? null;
    $this->timeOffType = $values['timeOffType'];
    $this->resourceId = $values['resourceId'] ?? null;
    $this->locationId = $values['locationId'] ?? null;
    $this->reason = $values['reason'] ?? null;
    $this->id = $values['id'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];

    $this->_dirtyFields = [
      'name' => true,
      'start_date' => true,
      'end_date' => true,
      'time_off_type' => true,
      'id' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true
    ];
    if (array_key_exists('holidayType', $values)) {
      $this->_dirtyFields['holiday_type'] = true;
    }
    if (array_key_exists('overrideHours', $values)) {
      $this->_dirtyFields['override_hours'] = true;
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
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'start_date',
      'contents' => json_encode($this->startDate),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'end_date',
      'contents' => json_encode($this->endDate),
      'headers' => ['Content-Type' => 'application/json']
    ];

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

    $parts[] = [
      'name' => 'time_off_type',
      'contents' => $this->timeOffType
    ];

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

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->startDate->validate();
    $this->endDate->validate();
    foreach ($this->overrideHours ?? [] as $item) {
      $item->validate();
    }
  }
}
