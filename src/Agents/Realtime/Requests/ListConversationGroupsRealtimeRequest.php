<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Realtime\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListConversationGroupsRealtimeRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many conversation groups to return. Can not exceed 100.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search If specified, only conversation groups whose title or description contains this string (case-insensitive) are returned.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
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
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
