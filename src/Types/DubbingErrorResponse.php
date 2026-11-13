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
class DubbingErrorResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable identifier for the failure, safe to branch on. New codes are added over time, so we recommend treating an unrecognized value as `internal_error`.
   */
  #[JsonProperty('code', required: true)]
  public string $code;

  /**
   * Human-readable description of the failure, for display. The wording may change at any time, so we recommend branching on `code` instead.
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * Whether resubmitting the same input could succeed. A value of false means the failure describes the input or the account, so an identical retry will fail the same way.
   */
  #[JsonProperty('retryable', required: true)]
  public bool $retryable;

  /**
   * @param array{
   *   code: string,
   *   message: string,
   *   retryable: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->code = $values['code'];
    $this->message = $values['message'];
    $this->retryable = $values['retryable'];

    $this->_dirtyFields = [
      'code' => true,
      'message' => true,
      'retryable' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'code',
      'contents' => $this->code
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    $parts[] = [
      'name' => 'retryable',
      'contents' => $this->retryable ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
