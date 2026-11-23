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
class AgentToolResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_tool_response', required: true)]
  public \ElevenLabs\Types\AgentToolResponseAgentToolResponse $agentToolResponse;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentToolResponseType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   agentToolResponse: \ElevenLabs\Types\AgentToolResponseAgentToolResponse,
   *   type?: ?value-of<\ElevenLabs\Types\AgentToolResponseType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentToolResponse = $values['agentToolResponse'];
    $this->type = $values['type'] ?? 'agent_tool_response';

    $this->_dirtyFields = [
      'agent_tool_response' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_tool_response',
      'contents' => json_encode($this->agentToolResponse),
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
    $this->agentToolResponse->validate();
  }
}
