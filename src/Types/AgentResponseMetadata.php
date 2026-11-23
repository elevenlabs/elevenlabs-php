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
class AgentResponseMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_response_metadata_event', required: true)]
  public \ElevenLabs\Types\AgentResponseMetadataAgentResponseMetadataEvent $agentResponseMetadataEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentResponseMetadataType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentResponseMetadataEvent: \ElevenLabs\Types\AgentResponseMetadataAgentResponseMetadataEvent,
   *   type?: ?value-of<\ElevenLabs\Types\AgentResponseMetadataType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentResponseMetadataEvent = $values['agentResponseMetadataEvent'];
    $this->type = $values['type'] ?? 'agent_response_metadata';

    $this->_dirtyFields = [
      'agent_response_metadata_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_response_metadata_event',
      'contents' => json_encode($this->agentResponseMetadataEvent),
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
    $this->agentResponseMetadataEvent->validate();
  }
}
