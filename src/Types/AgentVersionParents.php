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
class AgentVersionParents extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('in_branch_parent_id')]
  public ?string $inBranchParentId;

  #[JsonProperty('out_of_branch_parent_id')]
  public ?string $outOfBranchParentId;

  #[JsonProperty('merged_into_branch_id')]
  public ?string $mergedIntoBranchId;

  #[JsonProperty('merged_from_branch_id')]
  public ?string $mergedFromBranchId;

  #[JsonProperty('merged_from_version_id')]
  public ?string $mergedFromVersionId;

  #[JsonProperty('rebased_from_version_id')]
  public ?string $rebasedFromVersionId;

  /**
   * @param array{
   *   inBranchParentId?: ?string,
   *   outOfBranchParentId?: ?string,
   *   mergedIntoBranchId?: ?string,
   *   mergedFromBranchId?: ?string,
   *   mergedFromVersionId?: ?string,
   *   rebasedFromVersionId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->inBranchParentId = $values['inBranchParentId'] ?? null;
    $this->outOfBranchParentId = $values['outOfBranchParentId'] ?? null;
    $this->mergedIntoBranchId = $values['mergedIntoBranchId'] ?? null;
    $this->mergedFromBranchId = $values['mergedFromBranchId'] ?? null;
    $this->mergedFromVersionId = $values['mergedFromVersionId'] ?? null;
    $this->rebasedFromVersionId = $values['rebasedFromVersionId'] ?? null;

    if (array_key_exists('inBranchParentId', $values)) {
      $this->_dirtyFields['in_branch_parent_id'] = true;
    }
    if (array_key_exists('outOfBranchParentId', $values)) {
      $this->_dirtyFields['out_of_branch_parent_id'] = true;
    }
    if (array_key_exists('mergedIntoBranchId', $values)) {
      $this->_dirtyFields['merged_into_branch_id'] = true;
    }
    if (array_key_exists('mergedFromBranchId', $values)) {
      $this->_dirtyFields['merged_from_branch_id'] = true;
    }
    if (array_key_exists('mergedFromVersionId', $values)) {
      $this->_dirtyFields['merged_from_version_id'] = true;
    }
    if (array_key_exists('rebasedFromVersionId', $values)) {
      $this->_dirtyFields['rebased_from_version_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->inBranchParentId !== null) {
      $parts[] = [
        'name' => 'in_branch_parent_id',
        'contents' => $this->inBranchParentId
      ];
    }

    if ($this->outOfBranchParentId !== null) {
      $parts[] = [
        'name' => 'out_of_branch_parent_id',
        'contents' => $this->outOfBranchParentId
      ];
    }

    if ($this->mergedIntoBranchId !== null) {
      $parts[] = [
        'name' => 'merged_into_branch_id',
        'contents' => $this->mergedIntoBranchId
      ];
    }

    if ($this->mergedFromBranchId !== null) {
      $parts[] = [
        'name' => 'merged_from_branch_id',
        'contents' => $this->mergedFromBranchId
      ];
    }

    if ($this->mergedFromVersionId !== null) {
      $parts[] = [
        'name' => 'merged_from_version_id',
        'contents' => $this->mergedFromVersionId
      ];
    }

    if ($this->rebasedFromVersionId !== null) {
      $parts[] = [
        'name' => 'rebased_from_version_id',
        'contents' => $this->rebasedFromVersionId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
