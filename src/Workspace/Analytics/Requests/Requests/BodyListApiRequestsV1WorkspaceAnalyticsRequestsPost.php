<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Analytics\Requests\Requests;

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
class BodyListApiRequestsV1WorkspaceAnalyticsRequestsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Start of the time range as a Unix timestamp in milliseconds.
   */
  #[JsonProperty('start_time')]
  public ?int $startTime;

  /**
   * End of the time range as a Unix timestamp in milliseconds.
   */
  #[JsonProperty('end_time')]
  public ?int $endTime;

  #[JsonProperty('limit')]
  public ?int $limit;

  /**
   * @var ?value-of<\ElevenLabs\Workspace\Analytics\Requests\Types\BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort>
   * Optional timestamp sort direction. If omitted, defaults to desc when end_time is provided, otherwise asc.
   */
  #[JsonProperty('sort')]
  public ?string $sort;

  /**
   * @var \ElevenLabs\Types\ColumnFilter[]|null
   */
  #[JsonProperty('filters'), ArrayType([\ElevenLabs\Types\ColumnFilter::class])]
  public ?array $filters;

  #[JsonProperty('search')]
  public ?string $search;

  /**
   * @param array{
   *   startTime?: ?int,
   *   endTime?: ?int,
   *   limit?: ?int,
   *   sort?: ?value-of<\ElevenLabs\Workspace\Analytics\Requests\Types\BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort>,
   *   filters?: \ElevenLabs\Types\ColumnFilter[]|null,
   *   search?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->startTime = $values['startTime'] ?? null;
    $this->endTime = $values['endTime'] ?? null;
    $this->limit = $values['limit'] ?? null;
    $this->sort = $values['sort'] ?? null;
    $this->filters = $values['filters'] ?? null;
    $this->search = $values['search'] ?? null;

    if (array_key_exists('startTime', $values)) {
      $this->_dirtyFields['start_time'] = true;
    }
    if (array_key_exists('endTime', $values)) {
      $this->_dirtyFields['end_time'] = true;
    }
    if (array_key_exists('limit', $values)) {
      $this->_dirtyFields['limit'] = true;
    }
    if (array_key_exists('sort', $values)) {
      $this->_dirtyFields['sort'] = true;
    }
    if (array_key_exists('filters', $values)) {
      $this->_dirtyFields['filters'] = true;
    }
    if (array_key_exists('search', $values)) {
      $this->_dirtyFields['search'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->startTime !== null) {
      $parts[] = [
        'name' => 'start_time',
        'contents' => (string) $this->startTime
      ];
    }

    if ($this->endTime !== null) {
      $parts[] = [
        'name' => 'end_time',
        'contents' => (string) $this->endTime
      ];
    }

    if ($this->limit !== null) {
      $parts[] = [
        'name' => 'limit',
        'contents' => (string) $this->limit
      ];
    }

    if ($this->sort !== null) {
      $parts[] = [
        'name' => 'sort',
        'contents' => $this->sort
      ];
    }

    if ($this->filters !== null) {
      $parts[] = [
        'name' => 'filters',
        'contents' => json_encode($this->filters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->search !== null) {
      $parts[] = [
        'name' => 'search',
        'contents' => $this->search
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->startTime, 'start_time', min: 1577836800000);
    Validator::validateNumber($this->endTime, 'end_time', min: 1577836800000);
    Validator::validateNumber($this->limit, 'limit', min: 1, max: 1000);
    foreach ($this->filters ?? [] as $item) {
      $item->validate();
    }
  }
}
