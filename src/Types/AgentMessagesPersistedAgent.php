<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentMessagesPersistedAgent extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AgentMessagesPersistedAgentType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * ID of the agent branch to use for this conversation
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('overrides')]
  public ?\ElevenLabs\Types\AgentMessagesOverrides $overrides;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AgentMessagesPersistedAgentType>,
   *   agentId: string,
   *   branchId?: ?string,
   *   overrides?: ?\ElevenLabs\Types\AgentMessagesOverrides,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->overrides = $values['overrides'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'agent_id' => true
    ];
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('overrides', $values)) {
      $this->_dirtyFields['overrides'] = true;
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
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    if ($this->branchId !== null) {
      $parts[] = [
        'name' => 'branch_id',
        'contents' => $this->branchId
      ];
    }

    if ($this->overrides !== null) {
      $parts[] = [
        'name' => 'overrides',
        'contents' => json_encode($this->overrides),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->agentId, 'agent_id', minLength: 1);
    $this->overrides?->validate();
  }
}
