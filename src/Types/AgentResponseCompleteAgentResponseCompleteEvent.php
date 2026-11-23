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
class AgentResponseCompleteAgentResponseCompleteEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @param array{
   *   eventId: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->eventId = $values['eventId'];

    $this->_dirtyFields = [
      'event_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
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
