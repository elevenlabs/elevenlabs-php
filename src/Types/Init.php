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
class Init extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\InitType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\InitType>,
   *   conversationId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->conversationId = $values['conversationId'];

    $this->_dirtyFields = [
      'type' => true,
      'conversation_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
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
