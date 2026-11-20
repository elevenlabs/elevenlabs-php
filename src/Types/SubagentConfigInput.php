<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubagentConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SubAgentInput[]|null
   * Agents this agent can hand a single turn to.
   */
  #[JsonProperty('agents'), ArrayType([\ElevenLabs\Types\SubAgentInput::class])]
  public ?array $agents;

  /**
   * Lets this agent hand a single turn to a fresh copy of itself.
   */
  #[JsonProperty('self_subagent')]
  public ?\ElevenLabs\Types\SelfSubagent $selfSubagent;

  /**
   * @param array{
   *   agents?: \ElevenLabs\Types\SubAgentInput[]|null,
   *   selfSubagent?: ?\ElevenLabs\Types\SelfSubagent,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->agents = $values['agents'] ?? null;
    $this->selfSubagent = $values['selfSubagent'] ?? null;

    if (array_key_exists('agents', $values)) {
      $this->_dirtyFields['agents'] = true;
    }
    if (array_key_exists('selfSubagent', $values)) {
      $this->_dirtyFields['self_subagent'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->agents !== null) {
      $parts[] = [
        'name' => 'agents',
        'contents' => json_encode($this->agents),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->selfSubagent !== null) {
      $parts[] = [
        'name' => 'self_subagent',
        'contents' => json_encode($this->selfSubagent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->agents ?? [] as $item) {
      $item->validate();
    }
    Validator::validateArray($this->agents, 'agents', maxItems: 10);
    $this->selfSubagent?->validate();
  }
}
