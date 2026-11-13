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
class ConversationSummaryMessageModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationSummaryMessageModelRole>
   */
  #[JsonProperty('role', required: true)]
  public string $role;

  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   role: value-of<\ElevenLabs\Types\ConversationSummaryMessageModelRole>,
   *   message: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->role = $values['role'];
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'role' => true,
      'message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'role',
      'contents' => $this->role
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
