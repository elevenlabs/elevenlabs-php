<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Data for concurrency wait-queue status events.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class QueueStatusQueueStatusEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\QueueStatusQueueStatusEventStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\QueueStatusQueueStatusEventStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];

    $this->_dirtyFields = [
      'status' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
