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
class UserTranscriptUserTranscriptItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('role', required: true)]
  public string $role;

  #[JsonProperty('content', required: true)]
  public string $content;

  /**
   * @param array{
   *   role: string,
   *   content: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->role = $values['role'];
    $this->content = $values['content'];

    $this->_dirtyFields = [
      'role' => true,
      'content' => true
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
      'name' => 'content',
      'contents' => $this->content
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
