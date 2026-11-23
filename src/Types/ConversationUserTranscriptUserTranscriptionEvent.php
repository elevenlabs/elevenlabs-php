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
class ConversationUserTranscriptUserTranscriptionEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_transcript', required: true)]
  public string $userTranscript;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @param array{
   *   userTranscript: string,
   *   eventId: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userTranscript = $values['userTranscript'];
    $this->eventId = $values['eventId'];

    $this->_dirtyFields = [
      'user_transcript' => true,
      'event_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_transcript',
      'contents' => $this->userTranscript
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
