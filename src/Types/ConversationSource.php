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
class ConversationSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationSourceType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  /**
   * @param array{
   *   conversationId: string,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationSourceType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'conversation';
    $this->conversationId = $values['conversationId'];

    $this->_dirtyFields = [
      'conversation_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

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
