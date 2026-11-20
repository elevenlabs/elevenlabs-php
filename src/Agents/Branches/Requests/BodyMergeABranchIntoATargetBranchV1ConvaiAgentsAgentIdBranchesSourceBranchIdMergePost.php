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
class BodyMergeABranchIntoATargetBranchV1ConvaiAgentsAgentIdBranchesSourceBranchIdMergePost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the target branch to merge into.
   */
  public string $targetBranchId;

  /**
   * Whether to archive the source branch after merging
   */
  #[JsonProperty('archive_source_branch')]
  public ?bool $archiveSourceBranch;

  /**
   * Keep the source branch's value for every conflict instead of sending `conflict_resolutions`
   */
  #[JsonProperty('force')]
  public ?bool $force;

  /**
   * @var \ElevenLabs\Types\ConflictResolution[]|null
   * Side to keep, or custom text where the conflict accepts it, for each conflict the preview reported. A merge or rebase with conflicts is rejected unless there is one for every conflict, sent with both tip ids. On a merge it can't be combined with `force`, which lets the source win every conflict instead.
   */
  #[JsonProperty('conflict_resolutions'), ArrayType([\ElevenLabs\Types\ConflictResolution::class])]
  public ?array $conflictResolutions;

  /**
   * Source branch tip version the conflicts were resolved against (`source_tip_version_id` of the preview). The request fails with 409 if the branch moved since.
   */
  #[JsonProperty('source_tip_id')]
  public ?string $sourceTipId;

  /**
   * Target branch tip version the conflicts were resolved against (`target_tip_version_id` of the preview). The request fails with 409 if the branch moved since.
   */
  #[JsonProperty('target_tip_id')]
  public ?string $targetTipId;

  /**
   * @param array{
   *   targetBranchId: string,
   *   archiveSourceBranch?: ?bool,
   *   force?: ?bool,
   *   conflictResolutions?: \ElevenLabs\Types\ConflictResolution[]|null,
   *   sourceTipId?: ?string,
   *   targetTipId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetBranchId = $values['targetBranchId'];
    $this->archiveSourceBranch = $values['archiveSourceBranch'] ?? null;
    $this->force = $values['force'] ?? null;
    $this->conflictResolutions = $values['conflictResolutions'] ?? null;
    $this->sourceTipId = $values['sourceTipId'] ?? null;
    $this->targetTipId = $values['targetTipId'] ?? null;

    if (array_key_exists('archiveSourceBranch', $values)) {
      $this->_dirtyFields['archive_source_branch'] = true;
    }
    if (array_key_exists('force', $values)) {
      $this->_dirtyFields['force'] = true;
    }
    if (array_key_exists('conflictResolutions', $values)) {
      $this->_dirtyFields['conflict_resolutions'] = true;
    }
    if (array_key_exists('sourceTipId', $values)) {
      $this->_dirtyFields['source_tip_id'] = true;
    }
    if (array_key_exists('targetTipId', $values)) {
      $this->_dirtyFields['target_tip_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->archiveSourceBranch !== null) {
      $parts[] = [
        'name' => 'archive_source_branch',
        'contents' => $this->archiveSourceBranch ? 'true' : 'false'
      ];
    }

    if ($this->force !== null) {
      $parts[] = [
        'name' => 'force',
        'contents' => $this->force ? 'true' : 'false'
      ];
    }

    if ($this->conflictResolutions !== null) {
      $parts[] = [
        'name' => 'conflict_resolutions',
        'contents' => json_encode($this->conflictResolutions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sourceTipId !== null) {
      $parts[] = [
        'name' => 'source_tip_id',
        'contents' => $this->sourceTipId
      ];
    }

    if ($this->targetTipId !== null) {
      $parts[] = [
        'name' => 'target_tip_id',
        'contents' => $this->targetTipId
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
