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
class BatchFailureResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\BatchFailureResponseModelStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('error_code', required: true)]
  public int $errorCode;

  #[JsonProperty('error_status', required: true)]
  public string $errorStatus;

  #[JsonProperty('error_message', required: true)]
  public string $errorMessage;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\BatchFailureResponseModelStatus>,
   *   errorCode: int,
   *   errorStatus: string,
   *   errorMessage: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->errorCode = $values['errorCode'];
    $this->errorStatus = $values['errorStatus'];
    $this->errorMessage = $values['errorMessage'];

    $this->_dirtyFields = [
      'status' => true,
      'error_code' => true,
      'error_status' => true,
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
      'name' => 'error_code',
      'contents' => (string) $this->errorCode
    ];

    $parts[] = [
      'name' => 'error_status',
      'contents' => $this->errorStatus
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
