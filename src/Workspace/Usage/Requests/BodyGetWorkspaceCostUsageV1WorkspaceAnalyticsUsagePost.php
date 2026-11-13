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
class BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost extends JsonSerializableType
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
   * Bucket size in seconds, in whole UTC days. Pass 86400 for daily buckets or 604800 for weekly buckets, which start on Monday.
   */
  #[JsonProperty('interval_seconds', required: true)]
  public int $intervalSeconds;

  /**
   * @var array<value-of<\ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostGroupByItem>>|null
   */
  #[JsonProperty('group_by'), ArrayType(['string'])]
  public ?array $groupBy;

  /**
   * @var \ElevenLabs\Types\MetronomeUsageColumnFilter[]|null
   */
  #[JsonProperty('filters'), ArrayType([\ElevenLabs\Types\MetronomeUsageColumnFilter::class])]
  public ?array $filters;

  /**
   * @param array{
   *   startTime: int,
   *   endTime: int,
   *   intervalSeconds: int,
   *   groupBy?: array<value-of<\ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostGroupByItem>>|null,
   *   filters?: \ElevenLabs\Types\MetronomeUsageColumnFilter[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startTime = $values['startTime'];
    $this->endTime = $values['endTime'];
    $this->intervalSeconds = $values['intervalSeconds'];
    $this->groupBy = $values['groupBy'] ?? null;
    $this->filters = $values['filters'] ?? null;

    $this->_dirtyFields = [
      'start_time' => true,
      'end_time' => true,
      'interval_seconds' => true
    ];
    if (array_key_exists('groupBy', $values)) {
      $this->_dirtyFields['group_by'] = true;
    }
    if (array_key_exists('filters', $values)) {
      $this->_dirtyFields['filters'] = true;
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

    $parts[] = [
      'name' => 'interval_seconds',
      'contents' => (string) $this->intervalSeconds
    ];

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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->startTime, 'start_time', min: 1577836800000);
    Validator::validateNumber($this->endTime, 'end_time', min: 1577836800000);
    Validator::validateNumber(
      $this->intervalSeconds,
      'interval_seconds',
      min: 86400,
      multipleOf: 86400
    );
    foreach ($this->filters ?? [] as $item) {
      $item->validate();
    }
  }
}
