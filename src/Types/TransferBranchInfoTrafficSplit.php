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
class TransferBranchInfoTrafficSplit extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TransferBranchInfoTrafficSplitBranchReason>
   */
  #[JsonProperty('branch_reason', required: true)]
  public string $branchReason;

  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  #[JsonProperty('traffic_percentage', required: true)]
  public float $trafficPercentage;

  /**
   * @param array{
   *   branchReason: value-of<\ElevenLabs\Types\TransferBranchInfoTrafficSplitBranchReason>,
   *   branchId: string,
   *   trafficPercentage: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->branchReason = $values['branchReason'];
    $this->branchId = $values['branchId'];
    $this->trafficPercentage = $values['trafficPercentage'];

    $this->_dirtyFields = [
      'branch_reason' => true,
      'branch_id' => true,
      'traffic_percentage' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'branch_reason',
      'contents' => $this->branchReason
    ];

    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'traffic_percentage',
      'contents' => (string) $this->trafficPercentage
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
