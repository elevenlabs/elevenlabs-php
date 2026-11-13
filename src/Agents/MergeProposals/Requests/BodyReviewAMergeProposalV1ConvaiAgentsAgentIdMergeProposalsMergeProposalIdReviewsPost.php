<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\MergeProposals\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\MergeProposalReviewState>
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * Optional comment to leave with the review.
   */
  #[JsonProperty('comment')]
  public ?string $comment;

  /**
   * @param array{
   *   state: value-of<\ElevenLabs\Types\MergeProposalReviewState>,
   *   comment?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->state = $values['state'];
    $this->comment = $values['comment'] ?? null;

    $this->_dirtyFields = [
      'state' => true
    ];
    if (array_key_exists('comment', $values)) {
      $this->_dirtyFields['comment'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    if ($this->comment !== null) {
      $parts[] = [
        'name' => 'comment',
        'contents' => $this->comment
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->comment, 'comment', maxLength: 4096);
  }
}
