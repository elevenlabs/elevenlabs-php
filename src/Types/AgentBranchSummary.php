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
class AgentBranchSummary extends JsonSerializableType
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
   * ID of the parent branch
   */
  #[JsonProperty('parent_branch_id')]
  public ?string $parentBranchId;

  /**
   * Whether a draft exists for the branch
   */
  #[JsonProperty('draft_exists')]
  public ?bool $draftExists;

  /**
   * Unix seconds when the caller's draft on this branch was first created, or null when they have no draft. A draft created before last_committed_at was written against a config the branch has since moved past, so it may not reflect the current one.
   */
  #[JsonProperty('draft_created_at')]
  public ?int $draftCreatedAt;

  /**
   * Whether the caller's draft on this branch was created before the branch's last commit, meaning it was written against a config the branch has since moved past and may not reflect the current one.
   */
  #[JsonProperty('draft_is_behind_tip')]
  public ?bool $draftIsBehindTip;

  /**
   * Number of calls in the last 7 days
   */
  #[JsonProperty('calls_7d')]
  public ?int $calls7D;

  /**
   * Number of commits on this branch not yet on main, relative to their common ancestor. Null if it could not be computed (e.g. no common ancestor, or the branch history exceeds the comparison budget).
   */
  #[JsonProperty('commits_ahead')]
  public ?int $commitsAhead;

  /**
   * Number of commits on main not yet incorporated into this branch, relative to their common ancestor. Null if it could not be computed (e.g. no common ancestor, or the branch history exceeds the comparison budget).
   */
  #[JsonProperty('commits_behind')]
  public ?int $commitsBehind;

  /**
   * ID of the branch this branch's tip version was merged into, if any
   */
  #[JsonProperty('merged_into_branch_id')]
  public ?string $mergedIntoBranchId;

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
   *   parentBranchId?: ?string,
   *   draftExists?: ?bool,
   *   draftCreatedAt?: ?int,
   *   draftIsBehindTip?: ?bool,
   *   calls7D?: ?int,
   *   commitsAhead?: ?int,
   *   commitsBehind?: ?int,
   *   mergedIntoBranchId?: ?string,
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
    $this->parentBranchId = $values['parentBranchId'] ?? null;
    $this->draftExists = $values['draftExists'] ?? null;
    $this->draftCreatedAt = $values['draftCreatedAt'] ?? null;
    $this->draftIsBehindTip = $values['draftIsBehindTip'] ?? null;
    $this->calls7D = $values['calls7D'] ?? null;
    $this->commitsAhead = $values['commitsAhead'] ?? null;
    $this->commitsBehind = $values['commitsBehind'] ?? null;
    $this->mergedIntoBranchId = $values['mergedIntoBranchId'] ?? null;

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
    if (array_key_exists('parentBranchId', $values)) {
      $this->_dirtyFields['parent_branch_id'] = true;
    }
    if (array_key_exists('draftExists', $values)) {
      $this->_dirtyFields['draft_exists'] = true;
    }
    if (array_key_exists('draftCreatedAt', $values)) {
      $this->_dirtyFields['draft_created_at'] = true;
    }
    if (array_key_exists('draftIsBehindTip', $values)) {
      $this->_dirtyFields['draft_is_behind_tip'] = true;
    }
    if (array_key_exists('calls7D', $values)) {
      $this->_dirtyFields['calls_7d'] = true;
    }
    if (array_key_exists('commitsAhead', $values)) {
      $this->_dirtyFields['commits_ahead'] = true;
    }
    if (array_key_exists('commitsBehind', $values)) {
      $this->_dirtyFields['commits_behind'] = true;
    }
    if (array_key_exists('mergedIntoBranchId', $values)) {
      $this->_dirtyFields['merged_into_branch_id'] = true;
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

    if ($this->parentBranchId !== null) {
      $parts[] = [
        'name' => 'parent_branch_id',
        'contents' => $this->parentBranchId
      ];
    }

    if ($this->draftExists !== null) {
      $parts[] = [
        'name' => 'draft_exists',
        'contents' => $this->draftExists ? 'true' : 'false'
      ];
    }

    if ($this->draftCreatedAt !== null) {
      $parts[] = [
        'name' => 'draft_created_at',
        'contents' => (string) $this->draftCreatedAt
      ];
    }

    if ($this->draftIsBehindTip !== null) {
      $parts[] = [
        'name' => 'draft_is_behind_tip',
        'contents' => $this->draftIsBehindTip ? 'true' : 'false'
      ];
    }

    if ($this->calls7D !== null) {
      $parts[] = [
        'name' => 'calls_7d',
        'contents' => (string) $this->calls7D
      ];
    }

    if ($this->commitsAhead !== null) {
      $parts[] = [
        'name' => 'commits_ahead',
        'contents' => (string) $this->commitsAhead
      ];
    }

    if ($this->commitsBehind !== null) {
      $parts[] = [
        'name' => 'commits_behind',
        'contents' => (string) $this->commitsBehind
      ];
    }

    if ($this->mergedIntoBranchId !== null) {
      $parts[] = [
        'name' => 'merged_into_branch_id',
        'contents' => $this->mergedIntoBranchId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->syncStatus?->validate();
    $this->accessInfo?->validate();
  }
}
