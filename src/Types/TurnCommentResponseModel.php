<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TurnCommentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('turn_index', required: true)]
  public int $turnIndex;

  #[JsonProperty('comment', required: true)]
  public string $comment;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('owner_user_id', required: true)]
  public ?string $ownerUserId;

  /**
   * @param array{
   *   turnIndex: int,
   *   comment: string,
   *   createdAtUnixSecs: int,
   *   ownerUserId: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->turnIndex = $values['turnIndex'];
    $this->comment = $values['comment'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->ownerUserId = $values['ownerUserId'];

    $this->_dirtyFields = [
      'turn_index' => true,
      'comment' => true,
      'created_at_unix_secs' => true,
      'owner_user_id' => true
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

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'owner_user_id',
      'contents' => $this->ownerUserId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
