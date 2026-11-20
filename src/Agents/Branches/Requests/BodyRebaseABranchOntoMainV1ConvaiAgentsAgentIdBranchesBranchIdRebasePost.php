<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

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
class BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the branch to pull changes from. Defaults to the agent's main branch.
   */
  public ?string $sourceBranchId;

  /**
   * @var \ElevenLabs\Types\ConflictResolution[]|null
   * Side to keep, or custom text where the conflict accepts it, for each conflict the preview reported. A merge or rebase with conflicts is rejected unless there is one for every conflict, sent with both tip ids. On a merge it can't be combined with `force`, which lets the source win every conflict instead.
   */
  #[JsonProperty('conflict_resolutions'), ArrayType([\ElevenLabs\Types\ConflictResolution::class])]
  public ?array $conflictResolutions;

  /**
   * Tip version of the branch being rebased (`source_tip_version_id` of the rebase preview) the conflicts were resolved against. The request fails with 409 if it moved since.
   */
  #[JsonProperty('branch_tip_id')]
  public ?string $branchTipId;

  /**
   * Tip version of the branch the changes are pulled from (`source_branch_id`, the main branch by default; `target_tip_version_id` of the rebase preview) the conflicts were resolved against. The request fails with 409 if it moved since.
   */
  #[JsonProperty('source_tip_id')]
  public ?string $sourceTipId;

  /**
   * @param array{
   *   sourceBranchId?: ?string,
   *   conflictResolutions?: \ElevenLabs\Types\ConflictResolution[]|null,
   *   branchTipId?: ?string,
   *   sourceTipId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sourceBranchId = $values['sourceBranchId'] ?? null;
    $this->conflictResolutions = $values['conflictResolutions'] ?? null;
    $this->branchTipId = $values['branchTipId'] ?? null;
    $this->sourceTipId = $values['sourceTipId'] ?? null;

    if (array_key_exists('conflictResolutions', $values)) {
      $this->_dirtyFields['conflict_resolutions'] = true;
    }
    if (array_key_exists('branchTipId', $values)) {
      $this->_dirtyFields['branch_tip_id'] = true;
    }
    if (array_key_exists('sourceTipId', $values)) {
      $this->_dirtyFields['source_tip_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->conflictResolutions !== null) {
      $parts[] = [
        'name' => 'conflict_resolutions',
        'contents' => json_encode($this->conflictResolutions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->branchTipId !== null) {
      $parts[] = [
        'name' => 'branch_tip_id',
        'contents' => $this->branchTipId
      ];
    }

    if ($this->sourceTipId !== null) {
      $parts[] = [
        'name' => 'source_tip_id',
        'contents' => $this->sourceTipId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->conflictResolutions ?? [] as $item) {
      $item->validate();
    }
  }
}
