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
class ConversationPong extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationPongType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * ID of the ping event this pong responds to.
   */
  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @param array{
   *   eventId: int,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationPongType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'pong';
    $this->eventId = $values['eventId'];

    $this->_dirtyFields = [
      'event_id' => true
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
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
