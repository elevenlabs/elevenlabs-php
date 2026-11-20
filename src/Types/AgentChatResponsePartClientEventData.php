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
class AgentChatResponsePartClientEventData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var value-of<\ElevenLabs\Types\AgentChatResponsePartType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('response_id', required: true)]
  public string $responseId;

  /**
   * @param array{
   *   text: string,
   *   type: value-of<\ElevenLabs\Types\AgentChatResponsePartType>,
   *   eventId: int,
   *   responseId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->type = $values['type'];
    $this->eventId = $values['eventId'];
    $this->responseId = $values['responseId'];

    $this->_dirtyFields = [
      'text' => true,
      'type' => true,
      'event_id' => true,
      'response_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'event_id',
      'contents' => (string) $this->eventId
    ];

    $parts[] = [
      'name' => 'response_id',
      'contents' => $this->responseId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
