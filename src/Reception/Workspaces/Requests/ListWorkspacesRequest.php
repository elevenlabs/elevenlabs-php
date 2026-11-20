<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Workspaces\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListWorkspacesRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pagination cursor from previous response
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize Number of workspaces per page
   */
  public ?int $pageSize;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'cursor' => $data['cursor'] ?? null,
      'pageSize' => $data['page_size'] ?? null
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
    return $result;
  }
}
