<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\AnalysisItems\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AnalysisItemKind;
use ElevenLabs\Types\SortDirection;

class ListAnalysisItemsRequest extends JsonSerializableType
{
  /**
   * @var ?string $search If specified, only analysis items whose names start with this string are returned, ordered by relevance rather than sort_direction.
   */
  public ?string $search;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<AnalysisItemKind> $kind If specified, only analysis items of this kind are returned.
   */
  public ?string $kind;

  /**
   * @var ?array $analysisItemIds If specified, only analysis items with these IDs are returned.
   */
  public ?array $analysisItemIds;

  /**
   * @var ?string $createdByUserId Filter by creator user ID. Use '@me' to refer to the authenticated user.
   */
  public ?string $createdByUserId;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   search?: ?string,
   *   pageSize?: ?int,
   *   kind?: ?value-of<AnalysisItemKind>,
   *   analysisItemIds?: ?array,
   *   createdByUserId?: ?string,
   *   sortDirection?: ?value-of<SortDirection>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->search = $values['search'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->kind = $values['kind'] ?? null;
    $this->analysisItemIds = $values['analysisItemIds'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'search' => $data['search'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'kind' => $data['kind'] ?? null,
      'analysisItemIds' => $data['analysis_item_ids'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->kind !== null) {
      $result['kind'] = $this->kind;
    }
    if ($this->analysisItemIds !== null) {
      $result['analysis_item_ids'] = $this->analysisItemIds;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
