<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Usage\Requests;

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
class BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Start of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
   */
  #[JsonProperty('start_time', required: true)]
  public int $startTime;

  /**
   * End of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
   */
  #[JsonProperty('end_time', required: true)]
  public int $endTime;

  /**
   * Bucket size in seconds. Each row in the response covers this many seconds of the selected time range. For example, pass 3600 for hourly buckets, 86400 for daily buckets, or 604800 for weekly buckets. Whether `time_zone` shifts bucket boundaries depends on this value: week multiples (e.g. 604800) are calendar weeks that start Monday at local midnight; whole-day multiples that are not whole weeks (e.g. 86400) align to local midnight; whole-hour multiples up to 24 hours (e.g. 3600, 14400) align to local hour boundaries from midnight; sub-hour values and other sizes remain UTC-anchored regardless of `time_zone`.
   */
  #[JsonProperty('interval_seconds')]
  public ?int $intervalSeconds;

  /**
   * @var array<value-of<\ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostGroupByItem>>|null
   */
  #[JsonProperty('group_by'), ArrayType(['string'])]
  public ?array $groupBy;

  /**
   * @var \ElevenLabs\Types\ColumnFilter[]|null
   */
  #[JsonProperty('filters'), ArrayType([\ElevenLabs\Types\ColumnFilter::class])]
  public ?array $filters;

  /**
   * IANA time zone identifier (e.g. 'America/New_York', 'Europe/London', 'UTC') used to align bucket boundaries for eligible `interval_seconds` values. Week multiples (e.g. 604800) are calendar weeks that start Monday at local midnight. Whole-day multiples that are not whole weeks start at local midnight; whole-hour multiples up to 24 hours align to local hour boundaries from midnight. Sub-hour intervals and other bucket sizes remain UTC-anchored regardless of this setting. Defaults to UTC.
   */
  #[JsonProperty('time_zone')]
  public ?string $timeZone;

  /**
   * @param array{
   *   startTime: int,
   *   endTime: int,
   *   intervalSeconds?: ?int,
   *   groupBy?: array<value-of<\ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostGroupByItem>>|null,
   *   filters?: \ElevenLabs\Types\ColumnFilter[]|null,
   *   timeZone?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->intervalSeconds = $values['intervalSeconds'] ?? null;
    $this->groupBy = $values['groupBy'] ?? null;
    $this->filters = $values['filters'] ?? null;
    $this->timeZone = $values['timeZone'] ?? null;

    $this->_dirtyFields = [
      'start_time' => true,
      'end_time' => true
    ];
    if (array_key_exists('intervalSeconds', $values)) {
      $this->_dirtyFields['interval_seconds'] = true;
    }
    if (array_key_exists('groupBy', $values)) {
      $this->_dirtyFields['group_by'] = true;
    }
    if (array_key_exists('filters', $values)) {
      $this->_dirtyFields['filters'] = true;
    }
    if (array_key_exists('timeZone', $values)) {
      $this->_dirtyFields['time_zone'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_time',
      'contents' => (string) $this->startTime
    ];

    $parts[] = [
      'name' => 'end_time',
      'contents' => (string) $this->endTime
    ];

    if ($this->intervalSeconds !== null) {
      $parts[] = [
        'name' => 'interval_seconds',
        'contents' => (string) $this->intervalSeconds
      ];
    }

    if ($this->groupBy !== null) {
      foreach ($this->groupBy ?? [] as $item) {
        $parts[] = [
          'name' => 'group_by',
          'contents' => $item
        ];
      }
    }

    if ($this->filters !== null) {
      $parts[] = [
        'name' => 'filters',
        'contents' => json_encode($this->filters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->timeZone !== null) {
      $parts[] = [
        'name' => 'time_zone',
        'contents' => $this->timeZone
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->startTime, 'start_time', min: 1577836800000);
    Validator::validateNumber($this->endTime, 'end_time', min: 1577836800000);
    Validator::validateNumber($this->intervalSeconds, 'interval_seconds', min: 1);
    foreach ($this->filters ?? [] as $item) {
      $item->validate();
    }
  }
}
