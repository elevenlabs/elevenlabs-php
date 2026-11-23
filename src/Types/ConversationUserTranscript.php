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
class ConversationUserTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_transcription_event', required: true)]
  public \ElevenLabs\Types\ConversationUserTranscriptUserTranscriptionEvent $userTranscriptionEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationUserTranscriptType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   userTranscriptionEvent: \ElevenLabs\Types\ConversationUserTranscriptUserTranscriptionEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationUserTranscriptType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userTranscriptionEvent = $values['userTranscriptionEvent'];
    $this->type = $values['type'] ?? 'user_transcript';

    $this->_dirtyFields = [
      'user_transcription_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_transcription_event',
      'contents' => json_encode($this->userTranscriptionEvent),
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
    $this->userTranscriptionEvent->validate();
  }
}
