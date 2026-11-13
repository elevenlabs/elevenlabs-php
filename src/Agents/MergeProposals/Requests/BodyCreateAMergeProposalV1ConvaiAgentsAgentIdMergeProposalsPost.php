<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\MergeProposals\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Branch whose changes should be merged.
   */
  #[JsonProperty('source_branch_id', required: true)]
  public string $sourceBranchId;

  /**
   * Branch that should receive the changes.
   */
  #[JsonProperty('target_branch_id', required: true)]
  public string $targetBranchId;

  /**
   * Short title for the merge_proposal.
   */
  #[JsonProperty('title', required: true)]
  public string $title;

  /**
   * Optional longer description for reviewers.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * User IDs to request a review from.
   */
  #[JsonProperty('requested_reviewer_user_ids'), ArrayType(['string'])]
  public ?array $requestedReviewerUserIds;

  /**
   * Triage ticket of this agent that the merge_proposal resolves. Merging it resolves the ticket if still open.
   */
  #[JsonProperty('triage_ticket_id')]
  public ?string $triageTicketId;

  /**
   * @param array{
   *   sourceBranchId: string,
   *   targetBranchId: string,
   *   title: string,
   *   description?: ?string,
   *   requestedReviewerUserIds?: string[]|null,
   *   triageTicketId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceBranchId = $values['sourceBranchId'];
    $this->targetBranchId = $values['targetBranchId'];
    $this->title = $values['title'];
    $this->description = $values['description'] ?? null;
    $this->requestedReviewerUserIds = $values['requestedReviewerUserIds'] ?? null;
    $this->triageTicketId = $values['triageTicketId'] ?? null;

    $this->_dirtyFields = [
      'source_branch_id' => true,
      'target_branch_id' => true,
      'title' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('requestedReviewerUserIds', $values)) {
      $this->_dirtyFields['requested_reviewer_user_ids'] = true;
    }
    if (array_key_exists('triageTicketId', $values)) {
      $this->_dirtyFields['triage_ticket_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source_branch_id',
      'contents' => $this->sourceBranchId
    ];

    $parts[] = [
      'name' => 'target_branch_id',
      'contents' => $this->targetBranchId
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

    if ($this->triageTicketId !== null) {
      $parts[] = [
        'name' => 'triage_ticket_id',
        'contents' => $this->triageTicketId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->title, 'title', minLength: 1, maxLength: 140);
    Validator::validateString($this->description, 'description', maxLength: 4096);
    Validator::validateArray(
      $this->requestedReviewerUserIds,
      'requested_reviewer_user_ids',
      maxItems: 100
    );
  }
}
