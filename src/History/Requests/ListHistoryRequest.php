<?php

declare(strict_types=1);

namespace ElevenLabs\History\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\History\Types\ListHistoryRequestSortDirection;
use ElevenLabs\History\Types\ListHistoryRequestSource;

class ListHistoryRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many history items to return at maximum. Can not exceed 1000, defaults to 100.
   */
  public ?int $pageSize;

  /**
   * @var ?string $startAfterHistoryItemId After which ID to start fetching, use this parameter to paginate across a large collection of history items. In case this parameter is not provided history items will be fetched starting from the most recently created one ordered descending by their creation date.
   */
  public ?string $startAfterHistoryItemId;

  /**
   * @var ?string $voiceId ID of the voice to be filtered for. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   */
  public ?string $voiceId;

  /**
   * @var ?string $modelId Search term used for filtering history items. If provided, source becomes required.
   */
  public ?string $modelId;

  /**
   * @var ?int $dateBeforeUnix Unix timestamp to filter history items before this date (exclusive).
   */
  public ?int $dateBeforeUnix;

  /**
   * @var ?int $dateAfterUnix Unix timestamp to filter history items after this date (inclusive).
   */
  public ?int $dateAfterUnix;

  /**
   * @var ?value-of<ListHistoryRequestSortDirection> $sortDirection Sort direction for the results.
   */
  public ?string $sortDirection;

  /**
   * @var ?string $search search term used for filtering
   */
  public ?string $search;

  /**
   * @var ?value-of<ListHistoryRequestSource> $source Source of the generated history item
   */
  public ?string $source;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   startAfterHistoryItemId?: ?string,
   *   voiceId?: ?string,
   *   modelId?: ?string,
   *   dateBeforeUnix?: ?int,
   *   dateAfterUnix?: ?int,
   *   sortDirection?: ?value-of<ListHistoryRequestSortDirection>,
   *   search?: ?string,
   *   source?: ?value-of<ListHistoryRequestSource>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->startAfterHistoryItemId = $values['startAfterHistoryItemId'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->dateBeforeUnix = $values['dateBeforeUnix'] ?? null;
    $this->dateAfterUnix = $values['dateAfterUnix'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->source = $values['source'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'pageSize' => $data['page_size'] ?? null,
      'startAfterHistoryItemId' => $data['start_after_history_item_id'] ?? null,
      'voiceId' => $data['voice_id'] ?? null,
      'modelId' => $data['model_id'] ?? null,
      'dateBeforeUnix' => $data['date_before_unix'] ?? null,
      'dateAfterUnix' => $data['date_after_unix'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'search' => $data['search'] ?? null,
      'source' => $data['source'] ?? null
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
    if ($this->startAfterHistoryItemId !== null) {
      $result['start_after_history_item_id'] = $this->startAfterHistoryItemId;
    }
    if ($this->voiceId !== null) {
      $result['voice_id'] = $this->voiceId;
    }
    if ($this->modelId !== null) {
      $result['model_id'] = $this->modelId;
    }
    if ($this->dateBeforeUnix !== null) {
      $result['date_before_unix'] = $this->dateBeforeUnix;
    }
    if ($this->dateAfterUnix !== null) {
      $result['date_after_unix'] = $this->dateAfterUnix;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->source !== null) {
      $result['source'] = $this->source;
    }
    return $result;
  }
}
