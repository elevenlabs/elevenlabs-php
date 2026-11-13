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
class AgentWorkflowResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\WorkflowEdgeModelOutput>
   */
  #[
    JsonProperty('edges', required: true),
    ArrayType(['string' => \ElevenLabs\Types\WorkflowEdgeModelOutput::class])
  ]
  public array $edges;

  /**
   * @var array<string, \ElevenLabs\Types\AgentWorkflowResponseModelNodesValue>
   */
  #[
    JsonProperty('nodes', required: true),
    ArrayType(['string' => \ElevenLabs\Types\AgentWorkflowResponseModelNodesValue::class])
  ]
  public array $nodes;

  /**
   * Whether to prevent loops in the workflow execution.
   */
  #[JsonProperty('prevent_subagent_loops', required: true)]
  public bool $preventSubagentLoops;

  /**
   * @param array{
   *   edges: array<string, \ElevenLabs\Types\WorkflowEdgeModelOutput>,
   *   nodes: array<string, \ElevenLabs\Types\AgentWorkflowResponseModelNodesValue>,
   *   preventSubagentLoops: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->edges = $values['edges'];
    $this->nodes = $values['nodes'];
    $this->preventSubagentLoops = $values['preventSubagentLoops'];

    $this->_dirtyFields = [
      'edges' => true,
      'nodes' => true,
      'prevent_subagent_loops' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'edges',
      'contents' => json_encode($this->edges),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'nodes',
      'contents' => json_encode($this->nodes),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'prevent_subagent_loops',
      'contents' => $this->preventSubagentLoops ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
