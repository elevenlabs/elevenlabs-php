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
class AgentResponseMetadataAgentResponseMetadataEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('metadata', required: true)]
  public array $metadata;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @param array{
   *   metadata: array,
   *   eventId: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->metadata = $values['metadata'];
    $this->eventId = $values['eventId'];

    $this->_dirtyFields = [
      'metadata' => true,
      'event_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

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
