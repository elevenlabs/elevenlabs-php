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
class TicketStatusChangeResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AgentConversationTicketStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('changed_by_user_id', required: true)]
  public ?string $changedByUserId;

  #[JsonProperty('changed_at_unix_secs', required: true)]
  public int $changedAtUnixSecs;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\AgentConversationTicketStatus>,
   *   changedByUserId: ?string,
   *   changedAtUnixSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->changedByUserId = $values['changedByUserId'];
    $this->changedAtUnixSecs = $values['changedAtUnixSecs'];

    $this->_dirtyFields = [
      'status' => true,
      'changed_by_user_id' => true,
      'changed_at_unix_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'changed_by_user_id',
      'contents' => $this->changedByUserId
    ];

    $parts[] = [
      'name' => 'changed_at_unix_secs',
      'contents' => (string) $this->changedAtUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
