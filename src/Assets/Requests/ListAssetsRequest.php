<?php

declare(strict_types=1);

namespace ElevenLabs\Assets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListAssetsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize Number of assets to return.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Token from a previous response's `next_cursor`. Omit to fetch the first page.
   */
  public ?string $cursor;

  /**
   * @var ?string $search Optional free-text search filter over asset names.
   */
  public ?string $search;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   cursor?: ?string,
   *   search?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
    $this->search = $values['search'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'cursor' => $data['cursor'] ?? null,
      'search' => $data['search'] ?? null
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
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    return $result;
  }
}
