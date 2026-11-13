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
class BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * New title for the merge_proposal.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * New description for the merge_proposal.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * Replacement list of user IDs to request a review from.
   */
  #[JsonProperty('requested_reviewer_user_ids'), ArrayType(['string'])]
  public ?array $requestedReviewerUserIds;

  /**
   * When true, close the merge_proposal without merging.
   */
  #[JsonProperty('close')]
  public ?bool $close;

  /**
   * @param array{
   *   title?: ?string,
   *   description?: ?string,
   *   requestedReviewerUserIds?: string[]|null,
   *   close?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->requestedReviewerUserIds = $values['requestedReviewerUserIds'] ?? null;
    $this->close = $values['close'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('requestedReviewerUserIds', $values)) {
      $this->_dirtyFields['requested_reviewer_user_ids'] = true;
    }
    if (array_key_exists('close', $values)) {
      $this->_dirtyFields['close'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

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

    if ($this->close !== null) {
      $parts[] = [
        'name' => 'close',
        'contents' => $this->close ? 'true' : 'false'
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
