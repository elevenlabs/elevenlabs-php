<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tools\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\SortDirection;
use ElevenLabs\Types\ToolSortBy;

class ListToolsRequest extends JsonSerializableType
{
  /**
   * @var ?string $search If specified, the endpoint returns only tools whose names start with this string.
   */
  public ?string $search;

  /**
   * @var ?int $pageSize How many documents to return at maximum. Can not exceed 100, defaults to 30.
   */
  public ?int $pageSize;

  /**
   * @var ?bool $showOnlyOwnedDocuments If set to true, the endpoint will return only tools owned by you (and not shared from somebody else). Deprecated: use created_by_user_id instead.
   */
  public ?bool $showOnlyOwnedDocuments;

  /**
   * @var ?string $createdByUserId Filter tools by creator user ID. When set, only tools created by this user are returned. Takes precedence over show_only_owned_documents. Use '@me' to refer to the authenticated user.
   */
  public ?string $createdByUserId;

  /**
   * @var ?array $types If present, the endpoint will return only tools of the given types.
   */
  public ?array $types;

  /**
   * @var ?value-of<SortDirection> $sortDirection The direction to sort the results
   */
  public ?string $sortDirection;

  /**
   * @var ?value-of<ToolSortBy> $sortBy The field to sort the results by
   */
  public ?string $sortBy;

  /**
   * @var ?string $usedByAgentId Filter to tools referenced by this agent's main branch: tools attached to the agent, tools on authored workflow nodes, and tools referenced by procedures.
   */
  public ?string $usedByAgentId;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   search?: ?string,
   *   pageSize?: ?int,
   *   showOnlyOwnedDocuments?: ?bool,
   *   createdByUserId?: ?string,
   *   types?: ?array,
   *   sortDirection?: ?value-of<SortDirection>,
   *   sortBy?: ?value-of<ToolSortBy>,
   *   usedByAgentId?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->search = $values['search'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->showOnlyOwnedDocuments = $values['showOnlyOwnedDocuments'] ?? null;
    $this->createdByUserId = $values['createdByUserId'] ?? null;
    $this->types = $values['types'] ?? null;
    $this->sortDirection = $values['sortDirection'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->usedByAgentId = $values['usedByAgentId'] ?? null;
    $this->cursor = $values['cursor'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'search' => $data['search'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'showOnlyOwnedDocuments' => $data['show_only_owned_documents'] ?? null,
      'createdByUserId' => $data['created_by_user_id'] ?? null,
      'types' => $data['types'] ?? null,
      'sortDirection' => $data['sort_direction'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'usedByAgentId' => $data['used_by_agent_id'] ?? null,
      'cursor' => $data['cursor'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->showOnlyOwnedDocuments !== null) {
      $result['show_only_owned_documents'] = $this->showOnlyOwnedDocuments;
    }
    if ($this->createdByUserId !== null) {
      $result['created_by_user_id'] = $this->createdByUserId;
    }
    if ($this->types !== null) {
      $result['types'] = $this->types;
    }
    if ($this->sortDirection !== null) {
      $result['sort_direction'] = $this->sortDirection;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->usedByAgentId !== null) {
      $result['used_by_agent_id'] = $this->usedByAgentId;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
