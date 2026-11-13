<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentWorkflowRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\WorkflowEdgeModelInput>|null
   */
  #[JsonProperty('edges'), ArrayType(['string' => \ElevenLabs\Types\WorkflowEdgeModelInput::class])]
  public ?array $edges;

  /**
   * @var array<string, \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue>|null
   */
  #[
    JsonProperty('nodes'),
    ArrayType(['string' => \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::class])
  ]
  public ?array $nodes;

  /**
   * Whether to prevent loops in the workflow execution.
   */
  #[JsonProperty('prevent_subagent_loops')]
  public ?bool $preventSubagentLoops;

  /**
   * @param array{
   *   edges?: array<string, \ElevenLabs\Types\WorkflowEdgeModelInput>|null,
   *   nodes?: array<string, \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue>|null,
   *   preventSubagentLoops?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->edges = $values['edges'] ?? null;
    $this->nodes = $values['nodes'] ?? null;
    $this->preventSubagentLoops = $values['preventSubagentLoops'] ?? null;

    if (array_key_exists('edges', $values)) {
      $this->_dirtyFields['edges'] = true;
    }
    if (array_key_exists('nodes', $values)) {
      $this->_dirtyFields['nodes'] = true;
    }
    if (array_key_exists('preventSubagentLoops', $values)) {
      $this->_dirtyFields['prevent_subagent_loops'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->edges !== null) {
      $parts[] = [
        'name' => 'edges',
        'contents' => json_encode($this->edges),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->nodes !== null) {
      $parts[] = [
        'name' => 'nodes',
        'contents' => json_encode($this->nodes),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->preventSubagentLoops !== null) {
      $parts[] = [
        'name' => 'prevent_subagent_loops',
        'contents' => $this->preventSubagentLoops ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
