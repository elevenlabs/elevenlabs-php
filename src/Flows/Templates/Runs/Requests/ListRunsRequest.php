<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Templates\Runs\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListRunsRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many runs to return per page.
   */
  public ?int $pageSize;

  /**
   * @var ?string $versionId Only return runs of this template version id.
   */
  public ?string $versionId;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   versionId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->versionId = $values['versionId'] ?? null;
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
      'versionId' => $data['version_id'] ?? null
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
    if ($this->versionId !== null) {
      $result['version_id'] = $this->versionId;
    }
    return $result;
  }
}
