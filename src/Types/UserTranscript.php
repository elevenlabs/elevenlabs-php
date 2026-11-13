<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UserTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\UserTranscriptType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @var \ElevenLabs\Types\UserTranscriptUserTranscriptItem[]
   */
  #[
    JsonProperty('user_transcript', required: true),
    ArrayType([\ElevenLabs\Types\UserTranscriptUserTranscriptItem::class])
  ]
  public array $userTranscript;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\UserTranscriptType>,
   *   eventId: int,
   *   userTranscript: \ElevenLabs\Types\UserTranscriptUserTranscriptItem[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->eventId = $values['eventId'];
    $this->userTranscript = $values['userTranscript'];

    $this->_dirtyFields = [
      'type' => true,
      'event_id' => true,
      'user_transcript' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'user_transcript',
      'contents' => json_encode($this->userTranscript),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->userTranscript as $item) {
      $item->validate();
    }
  }
}
