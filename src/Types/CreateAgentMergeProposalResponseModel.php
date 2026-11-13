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
class CreateAgentMergeProposalResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the created merge_proposal
   */
  #[JsonProperty('created_merge_proposal_id', required: true)]
  public string $createdMergeProposalId;

  /**
   * @param array{
   *   createdMergeProposalId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->createdMergeProposalId = $values['createdMergeProposalId'];

    $this->_dirtyFields = [
      'created_merge_proposal_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'created_merge_proposal_id',
      'contents' => $this->createdMergeProposalId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
