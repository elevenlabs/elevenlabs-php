<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Dubbing\Project\Types\ListProjectRequestSortDirection;

class ListProjectRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pass the `next_cursor` from a previous response to fetch the page after it. Omit for the first page.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize Number of projects per page. Clamped to between 1 and 100 rather than rejected, so a larger value returns a full page.
   */
  public ?int $pageSize;

  /**
   * @var ?string $status Filter to projects in this status: `queued`, `preparing`, `ready`, or `failed`. Omit to return every status.
   */
  public ?string $status;

  /**
   * @var ?value-of<ListProjectRequestSortDirection> $sortDirection Sort by creation time; newest first by default.
   */
  public ?string $sortDirection;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   status?: ?string,
   *   sortDirection?: ?value-of<ListProjectRequestSortDirection>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'cursor' => $data['cursor'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'status' => $data['status'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    return $result;
  }
}
