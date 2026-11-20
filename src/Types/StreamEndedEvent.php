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
class StreamEndedEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\StreamEndedEventType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('stream_ended_event', required: true)]
  public \ElevenLabs\Types\StreamEndedData $streamEndedEvent;

  /**
   * @param array{
   *   streamEndedEvent: \ElevenLabs\Types\StreamEndedData,
   *   type?: ?value-of<\ElevenLabs\Types\StreamEndedEventType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'stream_ended';
    $this->streamEndedEvent = $values['streamEndedEvent'];

    $this->_dirtyFields = [
      'stream_ended_event' => true
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
      'name' => 'stream_ended_event',
      'contents' => json_encode($this->streamEndedEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->streamEndedEvent->validate();
  }
}
