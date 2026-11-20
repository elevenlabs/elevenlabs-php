<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AgentConversationTicketSortBy;
use ElevenLabs\Types\AgentConversationTicketStatus;

class ListForWorkspaceTriageTicketsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many agent issues to return. Can not exceed 100.
   */
  public ?int $pageSize;

  /**
   * @var ?string $agentId Only issues for this agent.
   */
  public ?string $agentId;

  /**
   * @var ?value-of<AgentConversationTicketStatus> $status Filter agent issues by status.
   */
  public ?string $status;

  /**
   * @var ?array $sources Filter agent issues by how they were raised (qa, agent, manual). Repeat the parameter to filter by multiple sources.
   */
  public ?array $sources;

  /**
   * @var ?array $priorities Filter agent issues by priority. Repeat the parameter to filter by multiple priorities.
   */
  public ?array $priorities;

  /**
   * @var ?value-of<AgentConversationTicketSortBy> $sortBy Order by most recently created, by priority (most urgent first, then most recently created), by most recently reported (the newest report merged into the agent issue, else its creation), or by report count (most reports merged into the agent issue first, then most recently created).
   */
  public ?string $sortBy;

  /**
   * @var ?string $ownerUserId Filter agent issues by creator. Use 'agent' for agent-raised issues.
   */
  public ?string $ownerUserId;

  /**
   * @var ?string $assigneeUserId Filter agent issues by assignee. Use 'unassigned' for issues with no assignee.
   */
  public ?string $assigneeUserId;

  /**
   * @var ?string $label Filter agent issues by an exact label.
   */
  public ?string $label;

  /**
   * @var ?string $mergedIntoTicketId Filter agent issues merged into this issue.
   */
  public ?string $mergedIntoTicketId;

  /**
   * @var ?string $search Case-insensitive free-text search across the agent issue's title, description, comments, and turn comments.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   agentId?: ?string,
   *   status?: ?value-of<AgentConversationTicketStatus>,
   *   sources?: ?array,
   *   priorities?: ?array,
   *   sortBy?: ?value-of<AgentConversationTicketSortBy>,
   *   ownerUserId?: ?string,
   *   assigneeUserId?: ?string,
   *   label?: ?string,
   *   mergedIntoTicketId?: ?string,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->agentId = $values['agentId'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->sources = $values['sources'] ?? null;
    $this->priorities = $values['priorities'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->ownerUserId = $values['ownerUserId'] ?? null;
    $this->assigneeUserId = $values['assigneeUserId'] ?? null;
    $this->label = $values['label'] ?? null;
    $this->mergedIntoTicketId = $values['mergedIntoTicketId'] ?? null;
    $this->search = $values['search'] ?? null;
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
      'agentId' => $data['agent_id'] ?? null,
      'status' => $data['status'] ?? null,
      'sources' => $data['sources'] ?? null,
      'priorities' => $data['priorities'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'ownerUserId' => $data['owner_user_id'] ?? null,
      'assigneeUserId' => $data['assignee_user_id'] ?? null,
      'label' => $data['label'] ?? null,
      'mergedIntoTicketId' => $data['merged_into_ticket_id'] ?? null,
      'search' => $data['search'] ?? null,
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
    if ($this->agentId !== null) {
      $result['agent_id'] = $this->agentId;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->sources !== null) {
      $result['sources'] = $this->sources;
    }
    if ($this->priorities !== null) {
      $result['priorities'] = $this->priorities;
    }
    if ($this->sortBy !== null) {
      $result['sort_by'] = $this->sortBy;
    }
    if ($this->ownerUserId !== null) {
      $result['owner_user_id'] = $this->ownerUserId;
    }
    if ($this->assigneeUserId !== null) {
      $result['assignee_user_id'] = $this->assigneeUserId;
    }
    if ($this->label !== null) {
      $result['label'] = $this->label;
    }
    if ($this->mergedIntoTicketId !== null) {
      $result['merged_into_ticket_id'] = $this->mergedIntoTicketId;
    }
    if ($this->search !== null) {
      $result['search'] = $this->search;
    }
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    return $result;
  }
}
