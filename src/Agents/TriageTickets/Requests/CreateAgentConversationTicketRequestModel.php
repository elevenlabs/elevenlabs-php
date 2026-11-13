<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\TriageTickets\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateAgentConversationTicketRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Conversation this ticket is about.
   */
  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * One-line headline shown in the triage list. Defaults to one derived from the comments, falling back to the conversation's summary title. Ignored when the comment is added to the conversation's open ticket.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * The issue this ticket is about, covering the whole conversation rather than a single turn.
   */
  #[JsonProperty('qa_comment')]
  public ?string $qaComment;

  /**
   * @var \ElevenLabs\Types\TurnCommentRequestModel[]|null
   * Optional turn-level comments on what went wrong.
   */
  #[JsonProperty('turn_comments'), ArrayType([\ElevenLabs\Types\TurnCommentRequestModel::class])]
  public ?array $turnComments;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>
   * How urgently the ticket needs attention. If the conversation already has an open ticket, it is raised to this priority when lower.
   */
  #[JsonProperty('priority')]
  public ?string $priority;

  /**
   * @param array{
   *   conversationId: string,
   *   title?: ?string,
   *   qaComment?: ?string,
   *   turnComments?: \ElevenLabs\Types\TurnCommentRequestModel[]|null,
   *   priority?: ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->title = $values['title'] ?? null;
    $this->qaComment = $values['qaComment'] ?? null;
    $this->turnComments = $values['turnComments'] ?? null;
    $this->priority = $values['priority'] ?? null;

    $this->_dirtyFields = [
      'conversation_id' => true
    ];
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('qaComment', $values)) {
      $this->_dirtyFields['qa_comment'] = true;
    }
    if (array_key_exists('turnComments', $values)) {
      $this->_dirtyFields['turn_comments'] = true;
    }
    if (array_key_exists('priority', $values)) {
      $this->_dirtyFields['priority'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

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

    if ($this->turnComments !== null) {
      $parts[] = [
        'name' => 'turn_comments',
        'contents' => json_encode($this->turnComments),
        'headers' => ['Content-Type' => 'application/json']
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
    foreach ($this->turnComments ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->turnComments, 'turn_comments', maxItems: 200);
  }
}
