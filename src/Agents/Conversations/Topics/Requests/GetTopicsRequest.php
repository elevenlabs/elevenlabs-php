<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Topics\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\SortDirection;
use ElevenLabs\Types\TopicSortBy;

class GetTopicsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize Number of top-level topic groups to return.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<TopicSortBy> $sortBy Column to rank topics by. Use conversations for volume, sentiment with sort_direction=asc for the most negative topics, and frustration with sort_direction=desc for the most frustrated ones. Topics with no score are always ranked last.
   */
  public ?string $sortBy;

  /**
   * @var ?value-of<SortDirection> $sortDirection Direction to sort topics.
   */
  public ?string $sortDirection;

  /**
   * @var ?int $fromUnixSecs Start of the window to view topics for. When set with to_unix_secs, the completed daily topic-discovery runs in the range are aggregated together, so the window scopes the metrics as well as the topic set. Floored to the start of its UTC day because runs cover whole UTC days; aggregated_run_count reports how many runs were summed. Omit both bounds to get the single latest run.
   */
  public ?int $fromUnixSecs;

  /**
   * @var ?int $toUnixSecs End of the window to view topics for.
   */
  public ?int $toUnixSecs;

  /**
   * @var ?bool $includeEvaluationCriteria Include the per-criteria evaluation breakdown on each topic's metrics. Pass false to drop it: it dominates the payload and the weighted success_rate is returned either way.
   */
  public ?bool $includeEvaluationCriteria;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   sortBy?: ?value-of<TopicSortBy>,
   *   sortDirection?: ?value-of<SortDirection>,
   *   fromUnixSecs?: ?int,
   *   toUnixSecs?: ?int,
   *   includeEvaluationCriteria?: ?bool,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->fromUnixSecs = $values['fromUnixSecs'] ?? null;
    $this->toUnixSecs = $values['toUnixSecs'] ?? null;
    $this->includeEvaluationCriteria = $values['includeEvaluationCriteria'] ?? null;
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
      'sortBy' => $data['sort_by'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'fromUnixSecs' => $data['from_unix_secs'] ?? null,
      'toUnixSecs' => $data['to_unix_secs'] ?? null,
      'includeEvaluationCriteria' => $data['include_evaluation_criteria'] ?? null,
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
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->fromUnixSecs !== null) {
      $result['from_unix_secs'] = $this->fromUnixSecs;
    }
    if ($this->toUnixSecs !== null) {
      $result['to_unix_secs'] = $this->toUnixSecs;
    }
    if ($this->includeEvaluationCriteria !== null) {
      $result['include_evaluation_criteria'] = $this->includeEvaluationCriteria;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
