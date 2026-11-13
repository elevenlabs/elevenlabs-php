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
class TicketMergeProposalLinkResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('merge_proposal_id', required: true)]
  public string $mergeProposalId;

  #[JsonProperty('linked_by_user_id', required: true)]
  public ?string $linkedByUserId;

  #[JsonProperty('linked_at_unix_secs', required: true)]
  public int $linkedAtUnixSecs;

  /**
   * @param array{
   *   mergeProposalId: string,
   *   linkedByUserId: ?string,
   *   linkedAtUnixSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mergeProposalId = $values['mergeProposalId'];
    $this->linkedByUserId = $values['linkedByUserId'];
    $this->linkedAtUnixSecs = $values['linkedAtUnixSecs'];

    $this->_dirtyFields = [
      'merge_proposal_id' => true,
      'linked_by_user_id' => true,
      'linked_at_unix_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'merge_proposal_id',
      'contents' => $this->mergeProposalId
    ];

    $parts[] = [
      'name' => 'linked_by_user_id',
      'contents' => $this->linkedByUserId
    ];

    $parts[] = [
      'name' => 'linked_at_unix_secs',
      'contents' => (string) $this->linkedAtUnixSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
