<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Status of a caller held in the concurrency wait queue. Sent once when the wait
 * starts (`waiting`) and once when it ends: `admitted` when the caller is connected
 * to the agent, or `timed_out` right before the connection is closed with code 4300.
 * Hold audio arrives as regular `audio` events while the caller waits.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class QueueStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Data for concurrency wait-queue status events.
   */
  #[JsonProperty('queue_status_event', required: true)]
  public \ElevenLabs\Types\QueueStatusQueueStatusEvent $queueStatusEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\QueueStatusType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   queueStatusEvent: \ElevenLabs\Types\QueueStatusQueueStatusEvent,
   *   type?: ?value-of<\ElevenLabs\Types\QueueStatusType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->queueStatusEvent = $values['queueStatusEvent'];
    $this->type = $values['type'] ?? 'queue_status';

    $this->_dirtyFields = [
      'queue_status_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'queue_status_event',
      'contents' => json_encode($this->queueStatusEvent),
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
    $this->queueStatusEvent->validate();
  }
}
