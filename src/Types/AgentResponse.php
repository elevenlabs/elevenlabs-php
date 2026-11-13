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
class AgentResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AgentResponseType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('event_id', required: true)]
  public int $eventId;

  #[JsonProperty('content')]
  public ?string $content;

  #[JsonProperty('is_final')]
  public ?bool $isFinal;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AgentResponseType>,
   *   eventId: int,
   *   content?: ?string,
   *   isFinal?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->eventId = $values['eventId'];
    $this->content = $values['content'] ?? null;
    $this->isFinal = $values['isFinal'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'event_id' => true
    ];
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
    }
    if (array_key_exists('isFinal', $values)) {
      $this->_dirtyFields['is_final'] = true;
    }
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

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => $this->content
      ];
    }

    if ($this->isFinal !== null) {
      $parts[] = [
        'name' => 'is_final',
        'contents' => $this->isFinal ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
