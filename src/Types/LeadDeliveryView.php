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
class LeadDeliveryView extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\BatchCallRecipientStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var value-of<\ElevenLabs\Types\LeadDeliveryViewStage>
   * The furthest the message got, or `failed` if sending it failed.
   */
  #[JsonProperty('stage', required: true)]
  public string $stage;

  #[JsonProperty('sent_at_unix', required: true)]
  public ?int $sentAtUnix;

  #[JsonProperty('delivered_at_unix', required: true)]
  public ?int $deliveredAtUnix;

  #[JsonProperty('read_at_unix', required: true)]
  public ?int $readAtUnix;

  #[JsonProperty('replied_at_unix', required: true)]
  public ?int $repliedAtUnix;

  #[JsonProperty('failed_at_unix', required: true)]
  public ?int $failedAtUnix;

  /**
   * Why the message failed to reach the contact.
   */
  #[JsonProperty('error_message', required: true)]
  public ?string $errorMessage;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\BatchCallRecipientStatus>,
   *   stage: value-of<\ElevenLabs\Types\LeadDeliveryViewStage>,
   *   sentAtUnix: ?int,
   *   deliveredAtUnix: ?int,
   *   readAtUnix: ?int,
   *   repliedAtUnix: ?int,
   *   failedAtUnix: ?int,
   *   errorMessage: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->stage = $values['stage'];
    $this->sentAtUnix = $values['sentAtUnix'];
    $this->deliveredAtUnix = $values['deliveredAtUnix'];
    $this->readAtUnix = $values['readAtUnix'];
    $this->repliedAtUnix = $values['repliedAtUnix'];
    $this->failedAtUnix = $values['failedAtUnix'];
    $this->errorMessage = $values['errorMessage'];

    $this->_dirtyFields = [
      'status' => true,
      'stage' => true,
      'sent_at_unix' => true,
      'delivered_at_unix' => true,
      'read_at_unix' => true,
      'replied_at_unix' => true,
      'failed_at_unix' => true,
      'error_message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'stage',
      'contents' => $this->stage
    ];

    $parts[] = [
      'name' => 'sent_at_unix',
      'contents' => (string) $this->sentAtUnix
    ];

    $parts[] = [
      'name' => 'delivered_at_unix',
      'contents' => (string) $this->deliveredAtUnix
    ];

    $parts[] = [
      'name' => 'read_at_unix',
      'contents' => (string) $this->readAtUnix
    ];

    $parts[] = [
      'name' => 'replied_at_unix',
      'contents' => (string) $this->repliedAtUnix
    ];

    $parts[] = [
      'name' => 'failed_at_unix',
      'contents' => (string) $this->failedAtUnix
    ];

    $parts[] = [
      'name' => 'error_message',
      'contents' => $this->errorMessage
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
