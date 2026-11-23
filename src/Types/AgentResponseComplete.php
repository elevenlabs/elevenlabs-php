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
class AgentResponseComplete extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_response_complete_event', required: true)]
  public \ElevenLabs\Types\AgentResponseCompleteAgentResponseCompleteEvent $agentResponseCompleteEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentResponseCompleteType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentResponseCompleteEvent: \ElevenLabs\Types\AgentResponseCompleteAgentResponseCompleteEvent,
   *   type?: ?value-of<\ElevenLabs\Types\AgentResponseCompleteType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentResponseCompleteEvent = $values['agentResponseCompleteEvent'];
    $this->type = $values['type'] ?? 'agent_response_complete';

    $this->_dirtyFields = [
      'agent_response_complete_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_response_complete_event',
      'contents' => json_encode($this->agentResponseCompleteEvent),
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
    $this->agentResponseCompleteEvent->validate();
  }
}
