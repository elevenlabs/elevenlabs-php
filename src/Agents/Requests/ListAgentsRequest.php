<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AgentSortBy;
use ElevenLabs\Types\SortDirection;

class ListAgentsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many Agents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?string $search Search by agents name.
   */
  public ?string $search;

  /**
   * @var ?bool $archived Filter agents by archived status
   */
  public ?bool $archived;

  /**
   * @var ?bool $showOnlyOwnedAgents If set to true, the endpoint will omit any agents that were shared with you by someone else and include only the ones you own. Deprecated: use created_by_user_id instead.
   */
  public ?bool $showOnlyOwnedAgents;

  /**
   * @var ?string $createdByUserId Filter agents by creator user ID. When set, only agents created by this user are returned. Takes precedence over show_only_owned_agents. Use '@me' to refer to the authenticated user.
   */
  public ?string $createdByUserId;

  /**
   * @var ?array $tags Filter agents by tag. Repeat the parameter to match any of several tags.
   */
  public ?array $tags;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?value-of<AgentSortBy> $sortBy The field to sort the results by
   */
  public ?string $sortBy;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   search?: ?string,
   *   archived?: ?bool,
   *   showOnlyOwnedAgents?: ?bool,
   *   createdByUserId?: ?string,
   *   tags?: ?array,
   *   sortDirection?: ?value-of<SortDirection>,
   *   sortBy?: ?value-of<AgentSortBy>,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->search = $values['search'] ?? null;
    $this->archived = $values['archived'] ?? null;
    $this->showOnlyOwnedAgents = $values['showOnlyOwnedAgents'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
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
      'archived' => $data['archived'] ?? null,
      'showOnlyOwnedAgents' => $data['show_only_owned_agents'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null,
      'tags' => $data['tags'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
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
    if ($this->archived !== null) {
      $result['archived'] = $this->archived;
    }
    if ($this->showOnlyOwnedAgents !== null) {
      $result['show_only_owned_agents'] = $this->showOnlyOwnedAgents;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    if ($this->tags !== null) {
      $result['tags'] = $this->tags;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
