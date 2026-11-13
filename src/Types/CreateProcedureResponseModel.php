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
class CreateProcedureResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the created procedure
   */
  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  /**
   * @param array{
   *   procedureId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedureId = $values['procedureId'];

    $this->_dirtyFields = [
      'procedure_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
