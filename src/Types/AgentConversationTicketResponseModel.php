<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentConversationTicketResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agentqa_ticket_id', required: true)]
  public string $agentqaTicketId;

  #[JsonProperty('workspace_id', required: true)]
  public string $workspaceId;

  #[JsonProperty('owner_user_id', required: true)]
  public string $ownerUserId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('needs_clustering', required: true)]
  public bool $needsClustering;

  /**
   * One-line headline for the ticket. None only on tickets created before titles existed.
   */
  #[JsonProperty('title', required: true)]
  public ?string $title;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketIssueType>
   */
  #[JsonProperty('issue_type', required: true)]
  public ?string $issueType;

  /**
   * @var string[]
   */
  #[JsonProperty('labels', required: true), ArrayType(['string'])]
  public array $labels;

  /**
   * @var string[]
   */
  #[JsonProperty('conversation_ids', required: true), ArrayType(['string'])]
  public array $conversationIds;

  #[JsonProperty('first_seen_unix_secs', required: true)]
  public ?int $firstSeenUnixSecs;

  #[JsonProperty('last_seen_unix_secs', required: true)]
  public ?int $lastSeenUnixSecs;

  #[JsonProperty('qa_comment', required: true)]
  public ?string $qaComment;

  /**
   * @var \ElevenLabs\Types\TicketCommentResponseModel[]
   */
  #[
    JsonProperty('ticket_comments', required: true),
    ArrayType([\ElevenLabs\Types\TicketCommentResponseModel::class])
  ]
  public array $ticketComments;

  /**
   * @var \ElevenLabs\Types\TurnCommentResponseModel[]
   */
  #[
    JsonProperty('turn_comments', required: true),
    ArrayType([\ElevenLabs\Types\TurnCommentResponseModel::class])
  ]
  public array $turnComments;

  /**
   * @var value-of<\ElevenLabs\Types\AgentConversationTicketStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>
   */
  #[JsonProperty('priority', required: true)]
  public ?string $priority;

  /**
   * @var \ElevenLabs\Types\TicketPriorityChangeResponseModel[]
   */
  #[
    JsonProperty('priority_changes', required: true),
    ArrayType([\ElevenLabs\Types\TicketPriorityChangeResponseModel::class])
  ]
  public array $priorityChanges;

  /**
   * @var \ElevenLabs\Types\TicketStatusChangeResponseModel[]
   */
  #[
    JsonProperty('status_changes', required: true),
    ArrayType([\ElevenLabs\Types\TicketStatusChangeResponseModel::class])
  ]
  public array $statusChanges;

  /**
   * The ticket this one was merged into, set while its status is 'merged'.
   */
  #[JsonProperty('merged_into_ticket_id')]
  public ?string $mergedIntoTicketId;

  /**
   * @var value-of<\ElevenLabs\Types\AgentConversationTicketSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  #[JsonProperty('assignee_user_id', required: true)]
  public ?string $assigneeUserId;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  /**
   * Where the list's `search` query matched. Set only on searched lists.
   */
  #[JsonProperty('search_match')]
  public ?\ElevenLabs\Types\TicketSearchMatchResponseModel $searchMatch;

  /**
   * @param array{
   *   agentqaTicketId: string,
   *   workspaceId: string,
   *   ownerUserId: string,
   *   agentId: string,
   *   needsClustering: bool,
   *   title: ?string,
   *   issueType: ?value-of<\ElevenLabs\Types\AgentConversationTicketIssueType>,
   *   labels: string[],
   *   conversationIds: string[],
   *   firstSeenUnixSecs: ?int,
   *   lastSeenUnixSecs: ?int,
   *   qaComment: ?string,
   *   ticketComments: \ElevenLabs\Types\TicketCommentResponseModel[],
   *   turnComments: \ElevenLabs\Types\TurnCommentResponseModel[],
   *   status: value-of<\ElevenLabs\Types\AgentConversationTicketStatus>,
   *   priority: ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>,
   *   priorityChanges: \ElevenLabs\Types\TicketPriorityChangeResponseModel[],
   *   statusChanges: \ElevenLabs\Types\TicketStatusChangeResponseModel[],
   *   source: value-of<\ElevenLabs\Types\AgentConversationTicketSource>,
   *   assigneeUserId: ?string,
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   mergedIntoTicketId?: ?string,
   *   searchMatch?: ?\ElevenLabs\Types\TicketSearchMatchResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentqaTicketId = $values['agentqaTicketId'];
    $this->workspaceId = $values['workspaceId'];
    $this->ownerUserId = $values['ownerUserId'];
    $this->agentId = $values['agentId'];
    $this->needsClustering = $values['needsClustering'];
    $this->title = $values['title'];
    $this->issueType = $values['issueType'];
    $this->labels = $values['labels'];
    $this->conversationIds = $values['conversationIds'];
    $this->firstSeenUnixSecs = $values['firstSeenUnixSecs'];
    $this->lastSeenUnixSecs = $values['lastSeenUnixSecs'];
    $this->qaComment = $values['qaComment'];
    $this->ticketComments = $values['ticketComments'];
    $this->turnComments = $values['turnComments'];
    $this->status = $values['status'];
    $this->priority = $values['priority'];
    $this->priorityChanges = $values['priorityChanges'];
    $this->statusChanges = $values['statusChanges'];
    $this->mergedIntoTicketId = $values['mergedIntoTicketId'] ?? null;
    $this->source = $values['source'];
    $this->assigneeUserId = $values['assigneeUserId'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->searchMatch = $values['searchMatch'] ?? null;

    $this->_dirtyFields = [
      'agentqa_ticket_id' => true,
      'workspace_id' => true,
      'owner_user_id' => true,
      'agent_id' => true,
      'needs_clustering' => true,
      'title' => true,
      'issue_type' => true,
      'labels' => true,
      'conversation_ids' => true,
      'first_seen_unix_secs' => true,
      'last_seen_unix_secs' => true,
      'qa_comment' => true,
      'ticket_comments' => true,
      'turn_comments' => true,
      'status' => true,
      'priority' => true,
      'priority_changes' => true,
      'status_changes' => true,
      'source' => true,
      'assignee_user_id' => true,
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true
    ];
    if (array_key_exists('mergedIntoTicketId', $values)) {
      $this->_dirtyFields['merged_into_ticket_id'] = true;
    }
    if (array_key_exists('searchMatch', $values)) {
      $this->_dirtyFields['search_match'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agentqa_ticket_id',
      'contents' => $this->agentqaTicketId
    ];

    $parts[] = [
      'name' => 'workspace_id',
      'contents' => $this->workspaceId
    ];

    $parts[] = [
      'name' => 'owner_user_id',
      'contents' => $this->ownerUserId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'needs_clustering',
      'contents' => $this->needsClustering ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'issue_type',
      'contents' => $this->issueType
    ];

    foreach ($this->labels as $item) {
      $parts[] = [
        'name' => 'labels',
        'contents' => $item
      ];
    }

    foreach ($this->conversationIds as $item) {
      $parts[] = [
        'name' => 'conversation_ids',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'first_seen_unix_secs',
      'contents' => (string) $this->firstSeenUnixSecs
    ];

    $parts[] = [
      'name' => 'last_seen_unix_secs',
      'contents' => (string) $this->lastSeenUnixSecs
    ];

    $parts[] = [
      'name' => 'qa_comment',
      'contents' => $this->qaComment
    ];

    $parts[] = [
      'name' => 'ticket_comments',
      'contents' => json_encode($this->ticketComments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'turn_comments',
      'contents' => json_encode($this->turnComments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'priority',
      'contents' => $this->priority
    ];

    $parts[] = [
      'name' => 'priority_changes',
      'contents' => json_encode($this->priorityChanges),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'status_changes',
      'contents' => json_encode($this->statusChanges),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->mergedIntoTicketId !== null) {
      $parts[] = [
        'name' => 'merged_into_ticket_id',
        'contents' => $this->mergedIntoTicketId
      ];
    }

    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
    ];

    $parts[] = [
      'name' => 'assignee_user_id',
      'contents' => $this->assigneeUserId
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    if ($this->searchMatch !== null) {
      $parts[] = [
        'name' => 'search_match',
        'contents' => json_encode($this->searchMatch),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->ticketComments as $item) {
      $item->validate();
    }
    foreach ($this->turnComments as $item) {
      $item->validate();
    }
    foreach ($this->priorityChanges as $item) {
      $item->validate();
    }
    foreach ($this->statusChanges as $item) {
      $item->validate();
    }
    $this->searchMatch?->validate();
  }
}
