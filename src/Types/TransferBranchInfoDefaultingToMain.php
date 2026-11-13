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
class TransferBranchInfoDefaultingToMain extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TransferBranchInfoDefaultingToMainBranchReason>
   */
  #[JsonProperty('branch_reason', required: true)]
  public string $branchReason;

  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  /**
   * @param array{
   *   branchReason: value-of<\ElevenLabs\Types\TransferBranchInfoDefaultingToMainBranchReason>,
   *   branchId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->branchReason = $values['branchReason'];
    $this->branchId = $values['branchId'];

    $this->_dirtyFields = [
      'branch_reason' => true,
      'branch_id' => true
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
