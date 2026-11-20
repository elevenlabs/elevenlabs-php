<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Holidays\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\TimeOffType;

class ListHolidaysRequest extends JsonSerializableType
{
  /**
   * @var ?int $startUnix Filter entries overlapping from this timestamp
   */
  public ?int $startUnix;

  /**
   * @var ?int $endUnix Filter entries overlapping before this timestamp
   */
  public ?int $endUnix;

  /**
   * @var ?value-of<TimeOffType> $timeOffType Filter by type: location, staff, or asset
   */
  public ?string $timeOffType;

  /**
   * @var ?string $resourceId Filter by associated resource ID (staff/asset)
   */
  public ?string $resourceId;

  /**
   * @var ?string $locationId Filter by location ID
   */
  public ?string $locationId;

  /**
   * @var string $xiWorkspaceId The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * @param array{
   *   startUnix?: ?int,
   *   endUnix?: ?int,
   *   timeOffType?: ?value-of<TimeOffType>,
   *   resourceId?: ?string,
   *   locationId?: ?string,
   *   xiWorkspaceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startUnix = $values['startUnix'] ?? null;
    $this->endUnix = $values['endUnix'] ?? null;
    $this->timeOffType = $values['timeOffType'] ?? null;
    $this->resourceId = $values['resourceId'] ?? null;
    $this->locationId = $values['locationId'] ?? null;
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'startUnix' => $data['start_unix'] ?? null,
      'endUnix' => $data['end_unix'] ?? null,
      'timeOffType' => $data['time_off_type'] ?? null,
      'resourceId' => $data['resource_id'] ?? null,
      'locationId' => $data['location_id'] ?? null,
      'xiWorkspaceId' => $data['xi-workspace-id']
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->startUnix !== null) {
      $result['start_unix'] = $this->startUnix;
    }
    if ($this->endUnix !== null) {
      $result['end_unix'] = $this->endUnix;
    }
    if ($this->timeOffType !== null) {
      $result['time_off_type'] = $this->timeOffType;
    }
    if ($this->resourceId !== null) {
      $result['resource_id'] = $this->resourceId;
    }
    if ($this->locationId !== null) {
      $result['location_id'] = $this->locationId;
    }
    $result['xi-workspace-id'] = $this->xiWorkspaceId;
    return $result;
  }
}
