<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\FinetuneCreatedBy;
use ElevenLabs\Types\FinetuneVisibility;
use ElevenLabs\Music\Finetunes\Types\ListFinetunesRequestSort;
use ElevenLabs\Music\Finetunes\Types\ListFinetunesRequestSortDirection;

class ListFinetunesRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Used for fetching the next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many finetunes to return. Max 150, default 50.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<FinetuneVisibility> $visibility Filter by visibility. 'private' returns private finetunes; 'workspace' returns workspace-shared finetunes; 'public' returns public finetunes, which are currently ElevenLabs curated finetunes. Omit to return all accessible finetunes.
   */
  public ?string $visibility;

  /**
   * @var ?value-of<FinetuneCreatedBy> $createdBy Filter by creator. 'self' returns finetunes you created; 'workspace' returns finetunes created by workspace teammates; 'elevenlabs' returns ElevenLabs curated finetunes. Omit to return finetunes from all creators.
   */
  public ?string $createdBy;

  /**
   * @var ?value-of<ListFinetunesRequestSort> $sort Sort by field (created_at or name)
   */
  public ?string $sort;

  /**
   * @var ?value-of<ListFinetunesRequestSortDirection> $sortDirection Sort direction (asc or desc)
   */
  public ?string $sortDirection;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   visibility?: ?value-of<FinetuneVisibility>,
   *   createdBy?: ?value-of<FinetuneCreatedBy>,
   *   sort?: ?value-of<ListFinetunesRequestSort>,
   *   sortDirection?: ?value-of<ListFinetunesRequestSortDirection>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->visibility = $values['visibility'] ?? null;
    $this->createdBy = $values['createdBy'] ?? null;
    $this->sort = $values['sort'] ?? null;
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
      'visibility' => $data['visibility'] ?? null,
      'createdBy' => $data['created_by'] ?? null,
      'sort' => $data['sort'] ?? null,
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
    if ($this->visibility !== null) {
      $result['visibility'] = $this->visibility;
    }
    if ($this->createdBy !== null) {
      $result['created_by'] = $this->createdBy;
    }
    if ($this->sort !== null) {
      $result['sort'] = $this->sort;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    return $result;
  }
}
