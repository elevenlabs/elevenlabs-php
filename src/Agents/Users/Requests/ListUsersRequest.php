<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Users\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\SortDirection;
use ElevenLabs\Types\UsersSortBy;

class ListUsersRequest extends JsonSerializableType
{
  /**
   * @var ?string $agentId Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
   */
  public ?string $agentId;

  /**
   * @var ?string $branchId Filter conversations by branch ID.
   */
  public ?string $branchId;

  /**
   * @var ?int $callStartBeforeUnix Unix timestamp (in seconds) to filter conversations up to this start date.
   */
  public ?int $callStartBeforeUnix;

  /**
   * @var ?int $callStartAfterUnix Unix timestamp (in seconds) to filter conversations after to this start date.
   */
  public ?int $callStartAfterUnix;

  /**
   * @var ?string $search Search/filter by user ID (exact match).
   */
  public ?string $search;

  /**
   * @var ?int $pageSize How many users to return at maximum. Defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<UsersSortBy> $sortBy The field to sort the results by. Defaults to last_contact_unix_secs.
   */
  public ?string $sortBy;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   agentId?: ?string,
   *   branchId?: ?string,
   *   callStartBeforeUnix?: ?int,
   *   callStartAfterUnix?: ?int,
   *   search?: ?string,
   *   pageSize?: ?int,
   *   sortBy?: ?value-of<UsersSortBy>,
   *   sortDirection?: ?value-of<SortDirection>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agentId = $values['agentId'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->callStartBeforeUnix = $values['callStartBeforeUnix'] ?? null;
    $this->callStartAfterUnix = $values['callStartAfterUnix'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'agentId' => $data['agent_id'] ?? null,
      'branchId' => $data['branch_id'] ?? null,
      'callStartBeforeUnix' => $data['call_start_before_unix'] ?? null,
      'callStartAfterUnix' => $data['call_start_after_unix'] ?? null,
      'search' => $data['search'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->branchId !== null) {
      $result['branch_id'] = $this->branchId;
    }
    if ($this->callStartBeforeUnix !== null) {
      $result['call_start_before_unix'] = $this->callStartBeforeUnix;
    }
    if ($this->callStartAfterUnix !== null) {
      $result['call_start_after_unix'] = $this->callStartAfterUnix;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
