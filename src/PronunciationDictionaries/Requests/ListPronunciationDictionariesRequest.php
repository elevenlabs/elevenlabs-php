<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\PronunciationDictionaries\Types\ListPronunciationDictionariesRequestSort;

class ListPronunciationDictionariesRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many pronunciation dictionaries to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<ListPronunciationDictionariesRequestSort> $sort Which field to sort by, one of 'created_at_unix' or 'name'.
   */
  public ?string $sort;

  /**
   * @var ?string $sortDirection Which direction to sort the voices in. 'ascending' or 'descending'.
   */
  public ?string $sortDirection;

  /**
   * @var ?bool $includeArchived Whether to include archived pronunciation dictionaries in the response.
   */
  public ?bool $includeArchived;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   sort?: ?value-of<ListPronunciationDictionariesRequestSort>,
   *   sortDirection?: ?string,
   *   includeArchived?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->sort = $values['sort'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->includeArchived = $values['includeArchived'] ?? null;
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
      'sort' => $data['sort'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'includeArchived' => $data['include_archived'] ?? null
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
    if ($this->sort !== null) {
      $result['sort'] = $this->sort;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->includeArchived !== null) {
      $result['include_archived'] = $this->includeArchived;
    }
    return $result;
  }
}
