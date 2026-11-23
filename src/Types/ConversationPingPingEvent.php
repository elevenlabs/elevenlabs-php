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
class ConversationPingPingEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('ping_ms')]
  public ?int $pingMs;

  /**
   * @param array{
   *   eventId: int,
   *   pingMs?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->eventId = $values['eventId'];
    $this->pingMs = $values['pingMs'] ?? null;

    $this->_dirtyFields = [
      'event_id' => true
    ];
    if (array_key_exists('pingMs', $values)) {
      $this->_dirtyFields['ping_ms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    if ($this->pingMs !== null) {
      $parts[] = [
        'name' => 'ping_ms',
        'contents' => (string) $this->pingMs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
