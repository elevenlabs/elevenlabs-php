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
class TokenResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('token', required: true)]
  public string $token;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * @param array{
   *   token: string,
   *   conversationId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->token = $values['token'];
    $this->conversationId = $values['conversationId'];

    $this->_dirtyFields = [
      'token' => true,
      'conversation_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'token',
      'contents' => $this->token
    ];

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
