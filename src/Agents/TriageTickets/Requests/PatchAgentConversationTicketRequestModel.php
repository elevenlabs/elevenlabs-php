<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PatchAgentConversationTicketRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If provided, updates the ticket title. Omit to leave unchanged.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * If provided, updates the ticket description. Omit to leave unchanged.
   */
  #[JsonProperty('qa_comment')]
  public ?string $qaComment;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketStatus>
   * If provided, updates the ticket status. Omit to leave unchanged.
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * If provided, updates who is responsible for resolving this ticket. Must be a workspace member with at least viewer access to the agent. Pass null to unassign. Omit to leave unchanged.
   */
  #[JsonProperty('assignee_user_id')]
  public ?string $assigneeUserId;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>
   * If provided, updates how urgently the ticket needs attention. Pass null to clear it. Omit to leave unchanged.
   */
  #[JsonProperty('priority')]
  public ?string $priority;

  /**
   * @param array{
   *   title?: ?string,
   *   qaComment?: ?string,
   *   status?: ?value-of<\ElevenLabs\Types\AgentConversationTicketStatus>,
   *   assigneeUserId?: ?string,
   *   priority?: ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->qaComment = $values['qaComment'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->assigneeUserId = $values['assigneeUserId'] ?? null;
    $this->priority = $values['priority'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('qaComment', $values)) {
      $this->_dirtyFields['qa_comment'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('assigneeUserId', $values)) {
      $this->_dirtyFields['assignee_user_id'] = true;
    }
    if (array_key_exists('priority', $values)) {
      $this->_dirtyFields['priority'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->qaComment !== null) {
      $parts[] = [
        'name' => 'qa_comment',
        'contents' => $this->qaComment
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->assigneeUserId !== null) {
      $parts[] = [
        'name' => 'assignee_user_id',
        'contents' => $this->assigneeUserId
      ];
    }

    if ($this->priority !== null) {
      $parts[] = [
        'name' => 'priority',
        'contents' => $this->priority
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->title, 'title', minLength: 1, maxLength: 120);
    Validator::validateString($this->qaComment, 'qa_comment', minLength: 1, maxLength: 10000);
  }
}
