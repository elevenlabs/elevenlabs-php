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
class ClosedOutcome extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClosedOutcomeStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * @var value-of<\ElevenLabs\Types\MergeProposalCloseReason>
   */
  #[JsonProperty('reason', required: true)]
  public string $reason;

  #[JsonProperty('at', required: true)]
  public int $at;

  #[JsonProperty('by_user_id', required: true)]
  public ?string $byUserId;

  /**
   * @param array{
   *   reason: value-of<\ElevenLabs\Types\MergeProposalCloseReason>,
   *   at: int,
   *   byUserId: ?string,
   *   status?: ?value-of<\ElevenLabs\Types\ClosedOutcomeStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'] ?? 'closed';
    $this->reason = $values['reason'];
    $this->at = $values['at'];
    $this->byUserId = $values['byUserId'];

    $this->_dirtyFields = [
      'reason' => true,
      'at' => true,
      'by_user_id' => true
    ];
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    $parts[] = [
      'name' => 'reason',
      'contents' => $this->reason
    ];

    $parts[] = [
      'name' => 'at',
      'contents' => (string) $this->at
    ];

    $parts[] = [
      'name' => 'by_user_id',
      'contents' => $this->byUserId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
