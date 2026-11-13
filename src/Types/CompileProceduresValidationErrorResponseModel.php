<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CompileProceduresValidationErrorResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\ProcedureValidationError[]>
   * Validation errors keyed by procedure ID.
   */
  #[
    JsonProperty('errors', required: true),
    ArrayType(['string' => [\ElevenLabs\Types\ProcedureValidationError::class]])
  ]
  public array $errors;

  /**
   * @param array{
   *   errors: array<string, \ElevenLabs\Types\ProcedureValidationError[]>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->errors = $values['errors'];

    $this->_dirtyFields = [
      'errors' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'errors',
      'contents' => json_encode($this->errors),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
