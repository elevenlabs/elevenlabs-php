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
class SubAgentOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SubAgentOutputExecutionMode>
   * Whether to wait for the reply, or keep going and get it later in the conversation.
   */
  #[JsonProperty('execution_mode')]
  public ?string $executionMode;

  /**
   * How long the agent may run before it's stopped.
   */
  #[JsonProperty('timeout_secs')]
  public ?int $timeoutSecs;

  /**
   * The agent to run. Must be in the same workspace.
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The branch to run. Defaults to the agent's live deployment.
   */
  #[JsonProperty('branch_id')]
  public ?string $branchId;

  /**
   * What the agent is for. Shown to the LLM when it picks an agent.
   */
  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * Values passed to the agent as dynamic variables.
   */
  #[JsonProperty('parameters')]
  public ?\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput $parameters;

  /**
   * @param array{
   *   agentId: string,
   *   description: string,
   *   executionMode?: ?value-of<\ElevenLabs\Types\SubAgentOutputExecutionMode>,
   *   timeoutSecs?: ?int,
   *   branchId?: ?string,
   *   parameters?: ?\ElevenLabs\Types\ObjectJsonSchemaPropertyOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->executionMode = $values['executionMode'] ?? null;
    $this->timeoutSecs = $values['timeoutSecs'] ?? null;
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->description = $values['description'];
    $this->parameters = $values['parameters'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true,
      'description' => true
    ];
    if (array_key_exists('executionMode', $values)) {
      $this->_dirtyFields['execution_mode'] = true;
    }
    if (array_key_exists('timeoutSecs', $values)) {
      $this->_dirtyFields['timeout_secs'] = true;
    }
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('parameters', $values)) {
      $this->_dirtyFields['parameters'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->executionMode !== null) {
      $parts[] = [
        'name' => 'execution_mode',
        'contents' => $this->executionMode
      ];
    }

    if ($this->timeoutSecs !== null) {
      $parts[] = [
        'name' => 'timeout_secs',
        'contents' => (string) $this->timeoutSecs
      ];
    }

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

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->parameters !== null) {
      $parts[] = [
        'name' => 'parameters',
        'contents' => json_encode($this->parameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->timeoutSecs, 'timeout_secs', min: 10, max: 3600);
    $this->parameters?->validate();
  }
}
