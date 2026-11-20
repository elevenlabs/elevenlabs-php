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
class StreamEnvelope extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('turn_id', required: true)]
  public string $turnId;

  #[JsonProperty('created_at_unix_ms', required: true)]
  public int $createdAtUnixMs;

  #[JsonProperty('event', required: true)]
  public \ElevenLabs\Types\StreamEnvelopeEvent $event;

  /**
   * @param array{
   *   conversationId: string,
   *   turnId: string,
   *   createdAtUnixMs: int,
   *   event: \ElevenLabs\Types\StreamEnvelopeEvent,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->turnId = $values['turnId'];
    $this->createdAtUnixMs = $values['createdAtUnixMs'];
    $this->event = $values['event'];

    $this->_dirtyFields = [
      'conversation_id' => true,
      'turn_id' => true,
      'created_at_unix_ms' => true,
      'event' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'turn_id',
      'contents' => $this->turnId
    ];

    $parts[] = [
      'name' => 'created_at_unix_ms',
      'contents' => (string) $this->createdAtUnixMs
    ];

    $parts[] = [
      'name' => 'event',
      'contents' => json_encode($this->event),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
