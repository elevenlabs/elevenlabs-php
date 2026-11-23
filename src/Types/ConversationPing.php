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
class ConversationPing extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('ping_event', required: true)]
  public \ElevenLabs\Types\ConversationPingPingEvent $pingEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationPingType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   pingEvent: \ElevenLabs\Types\ConversationPingPingEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationPingType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pingEvent = $values['pingEvent'];
    $this->type = $values['type'] ?? 'ping';

    $this->_dirtyFields = [
      'ping_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'ping_event',
      'contents' => json_encode($this->pingEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->pingEvent->validate();
  }
}
