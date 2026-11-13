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
class AgentBranchResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('description', required: true)]
  public string $description;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  #[JsonProperty('last_committed_at', required: true)]
  public int $lastCommittedAt;

  #[JsonProperty('is_archived', required: true)]
  public bool $isArchived;

  /**
   * @var ?value-of<\ElevenLabs\Types\BranchProtectionStatus>
   */
  #[JsonProperty('protection_status')]
  public ?string $protectionStatus;

  #[JsonProperty('auto_rebase')]
  public ?bool $autoRebase;

  /**
   * Set while the branch is kept in sync with another branch (Main today), pulling in its new versions automatically. Null when it is not synced.
   */
  #[JsonProperty('sync_status')]
  public ?\ElevenLabs\Types\BranchSyncStatus $syncStatus;

  /**
   * Access information for the branch
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * Percentage of traffic live on the branch
   */
  #[JsonProperty('current_live_percentage')]
  public ?float $currentLivePercentage;

  /**
   * Parent branch of the branch
   */
  #[JsonProperty('parent_branch')]
  public ?\ElevenLabs\Types\AgentBranchBasicInfo $parentBranch;

  /**
   * @var \ElevenLabs\Types\AgentVersionMetadata[]|null
   * Most recent versions on the branch
   */
  #[
    JsonProperty('most_recent_versions'),
    ArrayType([\ElevenLabs\Types\AgentVersionMetadata::class])
  ]
  public ?array $mostRecentVersions;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   agentId: string,
   *   description: string,
   *   createdAt: int,
   *   lastCommittedAt: int,
   *   isArchived: bool,
   *   protectionStatus?: ?value-of<\ElevenLabs\Types\BranchProtectionStatus>,
   *   autoRebase?: ?bool,
   *   syncStatus?: ?\ElevenLabs\Types\BranchSyncStatus,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   currentLivePercentage?: ?float,
   *   parentBranch?: ?\ElevenLabs\Types\AgentBranchBasicInfo,
   *   mostRecentVersions?: \ElevenLabs\Types\AgentVersionMetadata[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->agentId = $values['agentId'];
    $this->description = $values['description'];
    $this->createdAt = $values['createdAt'];
    $this->lastCommittedAt = $values['lastCommittedAt'];
    $this->isArchived = $values['isArchived'];
    $this->protectionStatus = $values['protectionStatus'] ?? null;
    $this->autoRebase = $values['autoRebase'] ?? null;
    $this->syncStatus = $values['syncStatus'] ?? null;
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->currentLivePercentage = $values['currentLivePercentage'] ?? null;
    $this->parentBranch = $values['parentBranch'] ?? null;
    $this->mostRecentVersions = $values['mostRecentVersions'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'agent_id' => true,
      'description' => true,
      'created_at' => true,
      'last_committed_at' => true,
      'is_archived' => true
    ];
    if (array_key_exists('protectionStatus', $values)) {
      $this->_dirtyFields['protection_status'] = true;
    }
    if (array_key_exists('autoRebase', $values)) {
      $this->_dirtyFields['auto_rebase'] = true;
    }
    if (array_key_exists('syncStatus', $values)) {
      $this->_dirtyFields['sync_status'] = true;
    }
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('currentLivePercentage', $values)) {
      $this->_dirtyFields['current_live_percentage'] = true;
    }
    if (array_key_exists('parentBranch', $values)) {
      $this->_dirtyFields['parent_branch'] = true;
    }
    if (array_key_exists('mostRecentVersions', $values)) {
      $this->_dirtyFields['most_recent_versions'] = true;
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
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    $parts[] = [
      'name' => 'last_committed_at',
      'contents' => (string) $this->lastCommittedAt
    ];

    $parts[] = [
      'name' => 'is_archived',
      'contents' => $this->isArchived ? 'true' : 'false'
    ];

    if ($this->protectionStatus !== null) {
      $parts[] = [
        'name' => 'protection_status',
        'contents' => $this->protectionStatus
      ];
    }

    if ($this->autoRebase !== null) {
      $parts[] = [
        'name' => 'auto_rebase',
        'contents' => $this->autoRebase ? 'true' : 'false'
      ];
    }

    if ($this->syncStatus !== null) {
      $parts[] = [
        'name' => 'sync_status',
        'contents' => json_encode($this->syncStatus),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->currentLivePercentage !== null) {
      $parts[] = [
        'name' => 'current_live_percentage',
        'contents' => (string) $this->currentLivePercentage
      ];
    }

    if ($this->parentBranch !== null) {
      $parts[] = [
        'name' => 'parent_branch',
        'contents' => json_encode($this->parentBranch),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->mostRecentVersions !== null) {
      $parts[] = [
        'name' => 'most_recent_versions',
        'contents' => json_encode($this->mostRecentVersions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->syncStatus?->validate();
    $this->accessInfo?->validate();
    $this->parentBranch?->validate();
    foreach ($this->mostRecentVersions ?? [] as $item) {
      $item->validate();
    }
  }
}
