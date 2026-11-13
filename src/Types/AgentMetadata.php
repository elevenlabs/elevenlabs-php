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
class AgentMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id')]
  public ?string $branchId;

  #[JsonProperty('workflow_node_id')]
  public ?string $workflowNodeId;

  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * @param array{
   *   agentId: string,
   *   branchId?: ?string,
   *   workflowNodeId?: ?string,
   *   versionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'] ?? null;
    $this->workflowNodeId = $values['workflowNodeId'] ?? null;
    $this->versionId = $values['versionId'] ?? null;

    $this->_dirtyFields = [
      'agent_id' => true
    ];
    if (array_key_exists('branchId', $values)) {
      $this->_dirtyFields['branch_id'] = true;
    }
    if (array_key_exists('workflowNodeId', $values)) {
      $this->_dirtyFields['workflow_node_id'] = true;
    }
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
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

    if ($this->workflowNodeId !== null) {
      $parts[] = [
        'name' => 'workflow_node_id',
        'contents' => $this->workflowNodeId
      ];
    }

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
