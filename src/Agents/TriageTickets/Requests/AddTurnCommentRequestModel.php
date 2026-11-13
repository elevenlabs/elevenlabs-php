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
class AddTurnCommentRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Zero-based index of the transcript turn this comment refers to.
   */
  #[JsonProperty('turn_index', required: true)]
  public int $turnIndex;

  /**
   * What went wrong at this turn.
   */
  #[JsonProperty('comment', required: true)]
  public string $comment;

  /**
   * @param array{
   *   turnIndex: int,
   *   comment: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->turnIndex = $values['turnIndex'];
    $this->comment = $values['comment'];

    $this->_dirtyFields = [
      'turn_index' => true,
      'comment' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'turn_index',
      'contents' => (string) $this->turnIndex
    ];

    $parts[] = [
      'name' => 'comment',
      'contents' => $this->comment
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->turnIndex, 'turn_index', min: 0);
    Validator::validateString($this->comment, 'comment', minLength: 1, maxLength: 10000);
  }
}
