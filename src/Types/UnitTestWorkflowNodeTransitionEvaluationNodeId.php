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
class UnitTestWorkflowNodeTransitionEvaluationNodeId extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\UnitTestWorkflowNodeTransitionEvaluationNodeIdType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The ID of the agent whose workflow contains the target node.
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * The ID of the workflow node that the agent should transition to.
   */
  #[JsonProperty('target_node_id', required: true)]
  public string $targetNodeId;

  /**
   * @param array{
   *   agentId: string,
   *   targetNodeId: string,
   *   type?: ?value-of<\ElevenLabs\Types\UnitTestWorkflowNodeTransitionEvaluationNodeIdType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'node_id';
    $this->agentId = $values['agentId'];
    $this->targetNodeId = $values['targetNodeId'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'target_node_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'target_node_id',
      'contents' => $this->targetNodeId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
