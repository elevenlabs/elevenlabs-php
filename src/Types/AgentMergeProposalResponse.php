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
class AgentMergeProposalResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('source_branch_id', required: true)]
  public string $sourceBranchId;

  #[JsonProperty('target_branch_id', required: true)]
  public string $targetBranchId;

  #[JsonProperty('source_tip_version_id_at_creation', required: true)]
  public string $sourceTipVersionIdAtCreation;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   */
  #[JsonProperty('requested_reviewer_user_ids'), ArrayType(['string'])]
  public ?array $requestedReviewerUserIds;

  /**
   * @var \ElevenLabs\Types\MergeProposalReview[]|null
   */
  #[JsonProperty('reviews'), ArrayType([\ElevenLabs\Types\MergeProposalReview::class])]
  public ?array $reviews;

  /**
   * @var \ElevenLabs\Types\MergeProposalComment[]|null
   */
  #[JsonProperty('comments'), ArrayType([\ElevenLabs\Types\MergeProposalComment::class])]
  public ?array $comments;

  #[JsonProperty('outcome')]
  public ?\ElevenLabs\Types\AgentMergeProposalResponseOutcome $outcome;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  #[JsonProperty('updated_at', required: true)]
  public int $updatedAt;

  /**
   * User ID of the merge_proposal's author.
   */
  #[JsonProperty('author_user_id')]
  public ?string $authorUserId;

  /**
   * Access information for the merge_proposal, including creator.
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * @param array{
   *   id: string,
   *   agentId: string,
   *   sourceBranchId: string,
   *   targetBranchId: string,
   *   sourceTipVersionIdAtCreation: string,
   *   title: string,
   *   createdAt: int,
   *   updatedAt: int,
   *   description?: ?string,
   *   requestedReviewerUserIds?: string[]|null,
   *   reviews?: \ElevenLabs\Types\MergeProposalReview[]|null,
   *   comments?: \ElevenLabs\Types\MergeProposalComment[]|null,
   *   outcome?: ?\ElevenLabs\Types\AgentMergeProposalResponseOutcome,
   *   authorUserId?: ?string,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->agentId = $values['agentId'];
    $this->sourceBranchId = $values['sourceBranchId'];
    $this->targetBranchId = $values['targetBranchId'];
    $this->sourceTipVersionIdAtCreation = $values['sourceTipVersionIdAtCreation'];
    $this->title = $values['title'];
    $this->description = $values['description'] ?? null;
    $this->requestedReviewerUserIds = $values['requestedReviewerUserIds'] ?? null;
    $this->reviews = $values['reviews'] ?? null;
    $this->comments = $values['comments'] ?? null;
    $this->outcome = $values['outcome'] ?? null;
    $this->createdAt = $values['createdAt'];
    $this->updatedAt = $values['updatedAt'];
    $this->authorUserId = $values['authorUserId'] ?? null;
    $this->accessInfo = $values['accessInfo'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'agent_id' => true,
      'source_branch_id' => true,
      'target_branch_id' => true,
      'source_tip_version_id_at_creation' => true,
      'title' => true,
      'created_at' => true,
      'updated_at' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('requestedReviewerUserIds', $values)) {
      $this->_dirtyFields['requested_reviewer_user_ids'] = true;
    }
    if (array_key_exists('reviews', $values)) {
      $this->_dirtyFields['reviews'] = true;
    }
    if (array_key_exists('comments', $values)) {
      $this->_dirtyFields['comments'] = true;
    }
    if (array_key_exists('outcome', $values)) {
      $this->_dirtyFields['outcome'] = true;
    }
    if (array_key_exists('authorUserId', $values)) {
      $this->_dirtyFields['author_user_id'] = true;
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

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'source_branch_id',
      'contents' => $this->sourceBranchId
    ];

    $parts[] = [
      'name' => 'target_branch_id',
      'contents' => $this->targetBranchId
    ];

    $parts[] = [
      'name' => 'source_tip_version_id_at_creation',
      'contents' => $this->sourceTipVersionIdAtCreation
    ];

    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->requestedReviewerUserIds !== null) {
      foreach ($this->requestedReviewerUserIds ?? [] as $item) {
        $parts[] = [
          'name' => 'requested_reviewer_user_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->reviews !== null) {
      $parts[] = [
        'name' => 'reviews',
        'contents' => json_encode($this->reviews),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->comments !== null) {
      $parts[] = [
        'name' => 'comments',
        'contents' => json_encode($this->comments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outcome !== null) {
      $parts[] = [
        'name' => 'outcome',
        'contents' => json_encode($this->outcome),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    $parts[] = [
      'name' => 'updated_at',
      'contents' => (string) $this->updatedAt
    ];

    if ($this->authorUserId !== null) {
      $parts[] = [
        'name' => 'author_user_id',
        'contents' => $this->authorUserId
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
    foreach ($this->reviews ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->comments ?? [] as $item) {
      $item->validate();
    }
    $this->accessInfo?->validate();
  }
}
