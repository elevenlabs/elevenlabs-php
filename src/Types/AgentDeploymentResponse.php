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
class AgentDeploymentResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, float>|null
   * Map of branch IDs to traffic percentages
   */
  #[JsonProperty('traffic_percentage_branch_id_map'), ArrayType(['string' => 'float'])]
  public ?array $trafficPercentageBranchIdMap;

  /**
   * @param array{
   *   trafficPercentageBranchIdMap?: array<string, float>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->trafficPercentageBranchIdMap = $values['trafficPercentageBranchIdMap'] ?? null;

    if (array_key_exists('trafficPercentageBranchIdMap', $values)) {
      $this->_dirtyFields['traffic_percentage_branch_id_map'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->trafficPercentageBranchIdMap !== null) {
      $parts[] = [
        'name' => 'traffic_percentage_branch_id_map',
        'contents' => json_encode($this->trafficPercentageBranchIdMap),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
