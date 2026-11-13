<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Templates\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListTemplatesRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many templates to return per page. Lower than the run list's ceiling because each row expands its versions' input and output schemas.
   */
  public ?int $pageSize;

  /**
   * @var ?int $versionsPerTemplate How many of each template's published versions to return, newest first. `has_more_versions` tells you when a template has more.
   */
  public ?int $versionsPerTemplate;

  /**
   * @var ?string $search Only return templates whose name or description contains this text.
   */
  public ?string $search;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   versionsPerTemplate?: ?int,
   *   search?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->versionsPerTemplate = $values['versionsPerTemplate'] ?? null;
    $this->search = $values['search'] ?? null;
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
      'versionsPerTemplate' => $data['versions_per_template'] ?? null,
      'search' => $data['search'] ?? null
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
    if ($this->versionsPerTemplate !== null) {
      $result['versions_per_template'] = $this->versionsPerTemplate;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    return $result;
  }
}
