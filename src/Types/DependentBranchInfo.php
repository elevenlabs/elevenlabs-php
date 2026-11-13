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
class DependentBranchInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('agent_name', required: true)]
  public string $agentName;

  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  #[JsonProperty('branch_name', required: true)]
  public string $branchName;

  #[JsonProperty('is_main', required: true)]
  public bool $isMain;

  /**
   * @param array{
   *   agentId: string,
   *   agentName: string,
   *   branchId: string,
   *   branchName: string,
   *   isMain: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->agentName = $values['agentName'];
    $this->branchId = $values['branchId'];
    $this->branchName = $values['branchName'];
    $this->isMain = $values['isMain'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'agent_name' => true,
      'branch_id' => true,
      'branch_name' => true,
      'is_main' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'agent_name',
      'contents' => $this->agentName
    ];

    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'branch_name',
      'contents' => $this->branchName
    ];

    $parts[] = [
      'name' => 'is_main',
      'contents' => $this->isMain ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
