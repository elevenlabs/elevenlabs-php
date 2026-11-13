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
class MergeProposalReview extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_id', required: true)]
  public string $userId;

  /**
   * @var value-of<\ElevenLabs\Types\MergeProposalReviewState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  #[JsonProperty('submitted_at', required: true)]
  public int $submittedAt;

  #[JsonProperty('comment')]
  public ?string $comment;

  /**
   * @var ?value-of<\ElevenLabs\Types\MergeProposalReviewReviewerRole>
   */
  #[JsonProperty('reviewer_role')]
  public ?string $reviewerRole;

  /**
   * @param array{
   *   userId: string,
   *   state: value-of<\ElevenLabs\Types\MergeProposalReviewState>,
   *   submittedAt: int,
   *   comment?: ?string,
   *   reviewerRole?: ?value-of<\ElevenLabs\Types\MergeProposalReviewReviewerRole>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userId = $values['userId'];
    $this->state = $values['state'];
    $this->submittedAt = $values['submittedAt'];
    $this->comment = $values['comment'] ?? null;
    $this->reviewerRole = $values['reviewerRole'] ?? null;

    $this->_dirtyFields = [
      'user_id' => true,
      'state' => true,
      'submitted_at' => true
    ];
    if (array_key_exists('comment', $values)) {
      $this->_dirtyFields['comment'] = true;
    }
    if (array_key_exists('reviewerRole', $values)) {
      $this->_dirtyFields['reviewer_role'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_id',
      'contents' => $this->userId
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    $parts[] = [
      'name' => 'submitted_at',
      'contents' => (string) $this->submittedAt
    ];

    if ($this->comment !== null) {
      $parts[] = [
        'name' => 'comment',
        'contents' => $this->comment
      ];
    }

    if ($this->reviewerRole !== null) {
      $parts[] = [
        'name' => 'reviewer_role',
        'contents' => $this->reviewerRole
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
