<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A failed media generation and why it failed.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MediaGenerationFailedResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier of the generation.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\MediaGenerationFailedResponseStatus>
   * The lifecycle status of the generation.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var value-of<\ElevenLabs\Types\MediaGenerationFailedResponseFailureReason>
   * The category of failure.
   */
  #[JsonProperty('failure_reason', required: true)]
  public string $failureReason;

  /**
   * A human-readable description of the failure. Failed generations are not charged.
   */
  #[JsonProperty('error_message', required: true)]
  public string $errorMessage;

  /**
   * @param array{
   *   id: string,
   *   status: value-of<\ElevenLabs\Types\MediaGenerationFailedResponseStatus>,
   *   failureReason: value-of<\ElevenLabs\Types\MediaGenerationFailedResponseFailureReason>,
   *   errorMessage: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->status = $values['status'];
    $this->failureReason = $values['failureReason'];
    $this->errorMessage = $values['errorMessage'];

    $this->_dirtyFields = [
      'id' => true,
      'status' => true,
      'failure_reason' => true,
      'error_message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'failure_reason',
      'contents' => $this->failureReason
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
