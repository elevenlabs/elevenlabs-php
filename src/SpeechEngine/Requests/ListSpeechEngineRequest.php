<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AgentSortBy;
use ElevenLabs\Types\SortDirection;

class ListSpeechEngineRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many Speech Engines to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Search term to filter Speech Engines by name
   */
  public ?string $search;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?value-of<AgentSortBy> $sortBy The field to sort the results by
   */
  public ?string $sortBy;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   sortDirection?: ?value-of<SortDirection>,
   *   sortBy?: ?value-of<AgentSortBy>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'search' => $data['search'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
