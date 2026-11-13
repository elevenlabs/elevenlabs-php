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
class AgentDeploymentHistoryItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the deployment
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var array<string, float>|null
   * Map of branch IDs to traffic percentages
   */
  #[JsonProperty('traffic_percentage_branch_id_map'), ArrayType(['string' => 'float'])]
  public ?array $trafficPercentageBranchIdMap;

  /**
   * Unix timestamp of when the traffic split was applied
   */
  #[JsonProperty('deployed_at_unix_secs', required: true)]
  public int $deployedAtUnixSecs;

  /**
   * Whether this is the live traffic split
   */
  #[JsonProperty('is_active', required: true)]
  public bool $isActive;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDeploymentSource>
   * What caused this traffic split change. Null for deployments created before this was recorded.
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * Access information for the deployment, including who created it
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @param array{
   *   id: string,
   *   deployedAtUnixSecs: int,
   *   isActive: bool,
   *   trafficPercentageBranchIdMap?: array<string, float>|null,
   *   source?: ?value-of<\ElevenLabs\Types\AgentDeploymentSource>,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->trafficPercentageBranchIdMap = $values['trafficPercentageBranchIdMap'] ?? null;
    $this->deployedAtUnixSecs = $values['deployedAtUnixSecs'];
    $this->isActive = $values['isActive'];
    $this->source = $values['source'] ?? null;
    $this->accessInfo = $values['accessInfo'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'deployed_at_unix_secs' => true,
      'is_active' => true
    ];
    if (array_key_exists('trafficPercentageBranchIdMap', $values)) {
      $this->_dirtyFields['traffic_percentage_branch_id_map'] = true;
    }
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->trafficPercentageBranchIdMap !== null) {
      $parts[] = [
        'name' => 'traffic_percentage_branch_id_map',
        'contents' => json_encode($this->trafficPercentageBranchIdMap),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'deployed_at_unix_secs',
      'contents' => (string) $this->deployedAtUnixSecs
    ];

    $parts[] = [
      'name' => 'is_active',
      'contents' => $this->isActive ? 'true' : 'false'
    ];

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo?->validate();
  }
}
