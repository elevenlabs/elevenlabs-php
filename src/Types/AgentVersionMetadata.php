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
class AgentVersionMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  #[JsonProperty('version_description', required: true)]
  public string $versionDescription;

  #[JsonProperty('seq_no_in_branch', required: true)]
  public int $seqNoInBranch;

  #[JsonProperty('time_committed_secs', required: true)]
  public int $timeCommittedSecs;

  #[JsonProperty('parents', required: true)]
  public \ElevenLabs\Types\AgentVersionParents $parents;

  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @var \ElevenLabs\Types\ResourceAccessInfo[]|null
   * For a merge into the main branch, the people who published the merged changes on the source branch (access_info is whoever ran the merge). Null when not recorded.
   */
  #[JsonProperty('merged_authors'), ArrayType([\ElevenLabs\Types\ResourceAccessInfo::class])]
  public ?array $mergedAuthors;

  /**
   * @param array{
   *   id: string,
   *   agentId: string,
   *   branchId: string,
   *   versionDescription: string,
   *   seqNoInBranch: int,
   *   timeCommittedSecs: int,
   *   parents: \ElevenLabs\Types\AgentVersionParents,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   mergedAuthors?: \ElevenLabs\Types\ResourceAccessInfo[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'];
    $this->versionDescription = $values['versionDescription'];
    $this->seqNoInBranch = $values['seqNoInBranch'];
    $this->timeCommittedSecs = $values['timeCommittedSecs'];
    $this->parents = $values['parents'];
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->mergedAuthors = $values['mergedAuthors'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'agent_id' => true,
      'branch_id' => true,
      'version_description' => true,
      'seq_no_in_branch' => true,
      'time_committed_secs' => true,
      'parents' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('mergedAuthors', $values)) {
      $this->_dirtyFields['merged_authors'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'version_description',
      'contents' => $this->versionDescription
    ];

    $parts[] = [
      'name' => 'seq_no_in_branch',
      'contents' => (string) $this->seqNoInBranch
    ];

    $parts[] = [
      'name' => 'time_committed_secs',
      'contents' => (string) $this->timeCommittedSecs
    ];

    $parts[] = [
      'name' => 'parents',
      'contents' => json_encode($this->parents),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->mergedAuthors !== null) {
      $parts[] = [
        'name' => 'merged_authors',
        'contents' => json_encode($this->mergedAuthors),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->parents->validate();
    $this->accessInfo?->validate();
    foreach ($this->mergedAuthors ?? [] as $item) {
      $item->validate();
    }
  }
}
