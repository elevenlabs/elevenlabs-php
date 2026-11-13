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
class AttentionView extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('attention_id', required: true)]
  public string $attentionId;

  #[JsonProperty('campaign_id', required: true)]
  public string $campaignId;

  /**
   * The cause, such as `agent_unavailable` or `phone_number_unavailable`.
   */
  #[JsonProperty('reason', required: true)]
  public string $reason;

  /**
   * What went wrong and how to fix it.
   */
  #[JsonProperty('detail', required: true)]
  public string $detail;

  /**
   * @var value-of<\ElevenLabs\Types\AttentionStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Whether a retry places the calls the item holds back. Items that can't be retried are closed by resolving them.
   */
  #[JsonProperty('retryable', required: true)]
  public bool $retryable;

  /**
   * The note recorded on resolving the item.
   */
  #[JsonProperty('resolution', required: true)]
  public ?string $resolution;

  #[JsonProperty('created_at_unix', required: true)]
  public int $createdAtUnix;

  #[JsonProperty('updated_at_unix', required: true)]
  public int $updatedAtUnix;

  /**
   * @param array{
   *   attentionId: string,
   *   campaignId: string,
   *   reason: string,
   *   detail: string,
   *   status: value-of<\ElevenLabs\Types\AttentionStatus>,
   *   retryable: bool,
   *   resolution: ?string,
   *   createdAtUnix: int,
   *   updatedAtUnix: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->attentionId = $values['attentionId'];
    $this->campaignId = $values['campaignId'];
    $this->reason = $values['reason'];
    $this->detail = $values['detail'];
    $this->status = $values['status'];
    $this->retryable = $values['retryable'];
    $this->resolution = $values['resolution'];
    $this->createdAtUnix = $values['createdAtUnix'];
    $this->updatedAtUnix = $values['updatedAtUnix'];

    $this->_dirtyFields = [
      'attention_id' => true,
      'campaign_id' => true,
      'reason' => true,
      'detail' => true,
      'status' => true,
      'retryable' => true,
      'resolution' => true,
      'created_at_unix' => true,
      'updated_at_unix' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'attention_id',
      'contents' => $this->attentionId
    ];

    $parts[] = [
      'name' => 'campaign_id',
      'contents' => $this->campaignId
    ];

    $parts[] = [
      'name' => 'reason',
      'contents' => $this->reason
    ];

    $parts[] = [
      'name' => 'detail',
      'contents' => $this->detail
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'retryable',
      'contents' => $this->retryable ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'resolution',
      'contents' => $this->resolution
    ];

    $parts[] = [
      'name' => 'created_at_unix',
      'contents' => (string) $this->createdAtUnix
    ];

    $parts[] = [
      'name' => 'updated_at_unix',
      'contents' => (string) $this->updatedAtUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
