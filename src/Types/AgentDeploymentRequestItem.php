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
class AgentDeploymentRequestItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the branch to deploy
   */
  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  #[JsonProperty('deployment_strategy', required: true)]
  public \ElevenLabs\Types\AgentDeploymentPercentageStrategy $deploymentStrategy;

  /**
   * @param array{
   *   branchId: string,
   *   deploymentStrategy: \ElevenLabs\Types\AgentDeploymentPercentageStrategy,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->branchId = $values['branchId'];
    $this->deploymentStrategy = $values['deploymentStrategy'];

    $this->_dirtyFields = [
      'branch_id' => true,
      'deployment_strategy' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'deployment_strategy',
      'contents' => json_encode($this->deploymentStrategy),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->deploymentStrategy->validate();
  }
}
