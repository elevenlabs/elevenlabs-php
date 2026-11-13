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
class MergeProposalComment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('user_id', required: true)]
  public string $userId;

  #[JsonProperty('body', required: true)]
  public string $body;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  /**
   * @param array{
   *   id: string,
   *   userId: string,
   *   body: string,
   *   createdAt: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->userId = $values['userId'];
    $this->body = $values['body'];
    $this->createdAt = $values['createdAt'];

    $this->_dirtyFields = [
      'id' => true,
      'user_id' => true,
      'body' => true,
      'created_at' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'body',
      'contents' => $this->body
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
