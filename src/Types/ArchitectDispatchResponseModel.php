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
class ArchitectDispatchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('architect_chat_id', required: true)]
  public string $architectChatId;

  #[JsonProperty('user_id', required: true)]
  public string $userId;

  #[JsonProperty('dispatched_at_unix_secs', required: true)]
  public int $dispatchedAtUnixSecs;

  /**
   * @param array{
   *   architectChatId: string,
   *   userId: string,
   *   dispatchedAtUnixSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->architectChatId = $values['architectChatId'];
    $this->userId = $values['userId'];
    $this->dispatchedAtUnixSecs = $values['dispatchedAtUnixSecs'];

    $this->_dirtyFields = [
      'architect_chat_id' => true,
      'user_id' => true,
      'dispatched_at_unix_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'architect_chat_id',
      'contents' => $this->architectChatId
    ];

    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'dispatched_at_unix_secs',
      'contents' => (string) $this->dispatchedAtUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
