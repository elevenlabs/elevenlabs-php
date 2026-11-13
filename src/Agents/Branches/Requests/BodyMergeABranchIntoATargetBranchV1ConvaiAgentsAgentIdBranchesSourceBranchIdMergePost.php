<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

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
   * Force source branch changes onto the target, overriding timestamp-based conflict resolution
   */
  #[JsonProperty('force')]
  public ?bool $force;

  /**
   * @param array{
   *   targetBranchId: string,
   *   archiveSourceBranch?: ?bool,
   *   force?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetBranchId = $values['targetBranchId'];
    $this->archiveSourceBranch = $values['archiveSourceBranch'] ?? null;
    $this->force = $values['force'] ?? null;

    if (array_key_exists('archiveSourceBranch', $values)) {
      $this->_dirtyFields['archive_source_branch'] = true;
    }
    if (array_key_exists('force', $values)) {
      $this->_dirtyFields['force'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
