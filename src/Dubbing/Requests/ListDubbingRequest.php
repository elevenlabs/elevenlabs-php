<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Dubbing\Types\ListDubbingRequestDubbingStatus;
use ElevenLabs\Dubbing\Types\ListDubbingRequestFilterByCreator;
use ElevenLabs\Dubbing\Types\ListDubbingRequestOrderBy;
use ElevenLabs\Dubbing\Types\ListDubbingRequestOrderDirection;

class ListDubbingRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many dubs to return at maximum. Can not exceed 200, defaults to 100.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<ListDubbingRequestDubbingStatus> $dubbingStatus What state the dub is currently in.
   */
  public ?string $dubbingStatus;

  /**
   * @var ?array $dubbingStatuses Filter by dubbing status.
   */
  public ?array $dubbingStatuses;

  /**
   * @var ?array $dubbingModels Filter by dubbing model generation.
   */
  public ?array $dubbingModels;

  /**
   * @var ?array $targetLanguageCodes Filter by target language code.
   */
  public ?array $targetLanguageCodes;

  /**
   * @var ?array $creationSources Filter by dubbing creation source.
   */
  public ?array $creationSources;

  /**
   * @var ?value-of<ListDubbingRequestFilterByCreator> $filterByCreator Filters who created the resources being listed, whether it was the user running the request or someone else that shared the resource with them.
   */
  public ?string $filterByCreator;

  /**
   * @var ?value-of<ListDubbingRequestOrderBy> $orderBy The field to use for ordering results from this query.
   */
  public ?string $orderBy;

  /**
   * @var ?value-of<ListDubbingRequestOrderDirection> $orderDirection The order direction to use for results from this query.
   */
  public ?string $orderDirection;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   dubbingStatus?: ?value-of<ListDubbingRequestDubbingStatus>,
   *   dubbingStatuses?: ?array,
   *   dubbingModels?: ?array,
   *   targetLanguageCodes?: ?array,
   *   creationSources?: ?array,
   *   filterByCreator?: ?value-of<ListDubbingRequestFilterByCreator>,
   *   orderBy?: ?value-of<ListDubbingRequestOrderBy>,
   *   orderDirection?: ?value-of<ListDubbingRequestOrderDirection>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->dubbingStatus = $values['dubbingStatus'] ?? null;
    $this->dubbingStatuses = $values['dubbingStatuses'] ?? null;
    $this->dubbingModels = $values['dubbingModels'] ?? null;
    $this->targetLanguageCodes = $values['targetLanguageCodes'] ?? null;
    $this->creationSources = $values['creationSources'] ?? null;
    $this->filterByCreator = $values['filterByCreator'] ?? null;
    $this->orderBy = $values['orderBy'] ?? null;
    $this->orderDirection = $values['orderDirection'] ?? null;
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
      'dubbingStatus' => $data['dubbing_status'] ?? null,
      'dubbingStatuses' => $data['dubbing_statuses'] ?? null,
      'dubbingModels' => $data['dubbing_models'] ?? null,
      'targetLanguageCodes' => $data['target_language_codes'] ?? null,
      'creationSources' => $data['creation_sources'] ?? null,
      'filterByCreator' => $data['filter_by_creator'] ?? null,
      'orderBy' => $data['order_by'] ?? null,
      'orderDirection' => $data['order_direction'] ?? null
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
    if ($this->dubbingStatus !== null) {
      $result['dubbing_status'] = $this->dubbingStatus;
    }
    if ($this->dubbingStatuses !== null) {
      $result['dubbing_statuses'] = $this->dubbingStatuses;
    }
    if ($this->dubbingModels !== null) {
      $result['dubbing_models'] = $this->dubbingModels;
    }
    if ($this->targetLanguageCodes !== null) {
      $result['target_language_codes'] = $this->targetLanguageCodes;
    }
    if ($this->creationSources !== null) {
      $result['creation_sources'] = $this->creationSources;
    }
    if ($this->filterByCreator !== null) {
      $result['filter_by_creator'] = $this->filterByCreator;
    }
    if ($this->orderBy !== null) {
      $result['order_by'] = $this->orderBy;
    }
    if ($this->orderDirection !== null) {
      $result['order_direction'] = $this->orderDirection;
    }
    return $result;
  }
}
