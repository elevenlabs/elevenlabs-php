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
class ConversationAgentResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_response_event', required: true)]
  public \ElevenLabs\Types\ConversationAgentResponseAgentResponseEvent $agentResponseEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationAgentResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentResponseEvent: \ElevenLabs\Types\ConversationAgentResponseAgentResponseEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ConversationAgentResponseType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentResponseEvent = $values['agentResponseEvent'];
    $this->type = $values['type'] ?? 'agent_response';

    $this->_dirtyFields = [
      'agent_response_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_response_event',
      'contents' => json_encode($this->agentResponseEvent),
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
    $this->agentResponseEvent->validate();
  }
}
