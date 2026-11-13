<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\CrawlJobs\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListCrawlJobsRequest extends JsonSerializableType
{
  /**
   * @var ?array $includeJobIds Ids of additional crawl jobs to retrieve
   */
  public ?array $includeJobIds;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   includeJobIds?: ?array,
   *   pageSize?: ?int,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->includeJobIds = $values['includeJobIds'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'includeJobIds' => $data['include_job_ids'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->includeJobIds !== null) {
      $result['include_job_ids'] = $this->includeJobIds;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
