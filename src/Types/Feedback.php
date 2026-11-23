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
class Feedback extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\FeedbackType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * ID of the agent response event being rated.
   */
  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  /**
   * @var ?value-of<\ElevenLabs\Types\FeedbackScore>
   * Feedback score for the referenced agent response. Null clears any previously submitted feedback for the event.
   */
  #[JsonProperty('score')]
  public ?string $score;

  /**
   * @param array{
   *   eventId: int,
   *   type?: ?value-of<\ElevenLabs\Types\FeedbackType>,
   *   score?: ?value-of<\ElevenLabs\Types\FeedbackScore>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'feedback';
    $this->eventId = $values['eventId'];
    $this->score = $values['score'] ?? null;

    $this->_dirtyFields = [
      'event_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('score', $values)) {
      $this->_dirtyFields['score'] = true;
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
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    if ($this->score !== null) {
      $parts[] = [
        'name' => 'score',
        'contents' => $this->score
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
