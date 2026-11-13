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
class CreateManualTicketRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * One-line headline shown in the triage list. Defaults to one derived from qa_comment.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * What the ticket is about, e.g. a follow-up task for the agent.
   */
  #[JsonProperty('qa_comment', required: true)]
  public string $qaComment;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>
   * How urgently the ticket needs attention.
   */
  #[JsonProperty('priority')]
  public ?string $priority;

  /**
   * @param array{
   *   qaComment: string,
   *   title?: ?string,
   *   priority?: ?value-of<\ElevenLabs\Types\AgentConversationTicketPriority>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'] ?? null;
    $this->qaComment = $values['qaComment'];
    $this->priority = $values['priority'] ?? null;

    $this->_dirtyFields = [
      'qa_comment' => true
    ];
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
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

    $parts[] = [
      'name' => 'qa_comment',
      'contents' => $this->qaComment
    ];

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
