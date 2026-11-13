<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\AgentConversationTicketIssueType;
use ElevenLabs\Types\AgentConversationTicketSortBy;
use ElevenLabs\Types\AgentConversationTicketStatus;

class ListTriageTicketsRequest extends JsonSerializableType
{
  /**
   * @var ?int $pageSize How many agent conversation tickets to return. Can not exceed 100.
   */
  public ?int $pageSize;

  /**
   * @var ?string $conversationId Filter tickets by conversation id.
   */
  public ?string $conversationId;

  /**
   * @var ?value-of<AgentConversationTicketStatus> $status Filter tickets by status.
   */
  public ?string $status;

  /**
   * @var ?array $sources Filter tickets by how they were raised (qa, agent, manual). Repeat the parameter to filter by multiple sources.
   */
  public ?array $sources;

  /**
   * @var ?array $priorities Filter tickets by priority. Repeat the parameter to filter by multiple priorities.
   */
  public ?array $priorities;

  /**
   * @var ?value-of<AgentConversationTicketSortBy> $sortBy Order by most recently created, by priority (most urgent first, then most recently created), or by most recently reported (the newest report merged into the issue, else its creation).
   */
  public ?string $sortBy;

  /**
   * @var ?string $ownerUserId Filter tickets by creator. Use 'agent' for agent-raised tickets.
   */
  public ?string $ownerUserId;

  /**
   * @var ?string $assigneeUserId Filter tickets by assignee. Use 'unassigned' for tickets with no assignee.
   */
  public ?string $assigneeUserId;

  /**
   * @var ?value-of<AgentConversationTicketIssueType> $issueType Filter clusters by issue type.
   */
  public ?string $issueType;

  /**
   * @var ?string $label Filter tickets by an exact label.
   */
  public ?string $label;

  /**
   * @var ?string $mergedIntoTicketId Filter tickets merged into this ticket.
   */
  public ?string $mergedIntoTicketId;

  /**
   * @var ?string $search Case-insensitive free-text search across the ticket's title, description, comments, and turn comments.
   */
  public ?string $search;

  /**
   * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
   */
  public ?string $cursor;

  /**
   * @param array{
   *   pageSize?: ?int,
   *   conversationId?: ?string,
   *   status?: ?value-of<AgentConversationTicketStatus>,
   *   sources?: ?array,
   *   priorities?: ?array,
   *   sortBy?: ?value-of<AgentConversationTicketSortBy>,
   *   ownerUserId?: ?string,
   *   assigneeUserId?: ?string,
   *   issueType?: ?value-of<AgentConversationTicketIssueType>,
   *   label?: ?string,
   *   mergedIntoTicketId?: ?string,
   *   search?: ?string,
   *   cursor?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->pageSize = $values['pageSize'] ?? null;
    $this->conversationId = $values['conversationId'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->sources = $values['sources'] ?? null;
    $this->priorities = $values['priorities'] ?? null;
    $this->sortBy = $values['sortBy'] ?? null;
    $this->ownerUserId = $values['ownerUserId'] ?? null;
    $this->assigneeUserId = $values['assigneeUserId'] ?? null;
    $this->issueType = $values['issueType'] ?? null;
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
      'conversationId' => $data['conversation_id'] ?? null,
      'status' => $data['status'] ?? null,
      'sources' => $data['sources'] ?? null,
      'priorities' => $data['priorities'] ?? null,
      'sortBy' => $data['sort_by'] ?? null,
      'ownerUserId' => $data['owner_user_id'] ?? null,
      'assigneeUserId' => $data['assignee_user_id'] ?? null,
      'issueType' => $data['issue_type'] ?? null,
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
    if ($this->conversationId !== null) {
      $result['conversation_id'] = $this->conversationId;
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
    if ($this->issueType !== null) {
      $result['issue_type'] = $this->issueType;
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
