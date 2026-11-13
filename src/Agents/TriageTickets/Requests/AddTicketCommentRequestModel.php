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
class AddTicketCommentRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A comment discussing how to resolve the ticket.
   */
  #[JsonProperty('comment', required: true)]
  public string $comment;

  /**
   * @param array{
   *   comment: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->comment = $values['comment'];

    $this->_dirtyFields = [
      'comment' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'comment',
      'contents' => $this->comment
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->comment, 'comment', minLength: 1, maxLength: 10000);
  }
}
