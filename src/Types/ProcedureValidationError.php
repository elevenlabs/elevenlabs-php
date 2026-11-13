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
class ProcedureValidationError extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * JSON path to the error, e.g. 'trigger', 'steps[0].instruction'
   */
  #[JsonProperty('path', required: true)]
  public string $path;

  /**
   * Human-readable error message
   */
  #[JsonProperty('message', required: true)]
  public string $message;

  /**
   * @param array{
   *   path: string,
   *   message: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->path = $values['path'];
    $this->message = $values['message'];

    $this->_dirtyFields = [
      'path' => true,
      'message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'path',
      'contents' => $this->path
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
