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
class AgentToolRequestStreamedEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_tool_request', required: true)]
  public \ElevenLabs\Types\AgentToolRequestClientEventData $agentToolRequest;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentToolRequestStreamedEventType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentToolRequest: \ElevenLabs\Types\AgentToolRequestClientEventData,
   *   type?: ?value-of<\ElevenLabs\Types\AgentToolRequestStreamedEventType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentToolRequest = $values['agentToolRequest'];
    $this->type = $values['type'] ?? 'agent_tool_request';

    $this->_dirtyFields = [
      'agent_tool_request' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_tool_request',
      'contents' => json_encode($this->agentToolRequest),
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
    $this->agentToolRequest->validate();
  }
}
