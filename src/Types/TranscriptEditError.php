<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * An error returned in place of an edited transcript when the edit could not be produced.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TranscriptEditError extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TranscriptEditErrorKind>
   */
  #[JsonProperty('kind', required: true)]
  public string $kind;

  /**
   * @var value-of<\ElevenLabs\Types\TranscriptEditErrorErrorType>
   * edit_failed: the edit could not be produced.
   */
  #[JsonProperty('error_type', required: true)]
  public string $errorType;

  /**
   * A short, user-facing explanation of the failure.
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   kind: value-of<\ElevenLabs\Types\TranscriptEditErrorKind>,
   *   errorType: value-of<\ElevenLabs\Types\TranscriptEditErrorErrorType>,
   *   message: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'];
    $this->errorType = $values['errorType'];
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'kind' => true,
      'error_type' => true,
      'message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'kind',
      'contents' => $this->kind
    ];

    $parts[] = [
      'name' => 'error_type',
      'contents' => $this->errorType
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
