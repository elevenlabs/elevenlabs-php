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
class ListProceduresResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ProcedureListItemResponseModel[]
   * Procedures on the branch with their draft-aware metadata.
   */
  #[
    JsonProperty('procedures', required: true),
    ArrayType([\ElevenLabs\Types\ProcedureListItemResponseModel::class])
  ]
  public array $procedures;

  /**
   * @param array{
   *   procedures: \ElevenLabs\Types\ProcedureListItemResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedures = $values['procedures'];

    $this->_dirtyFields = [
      'procedures' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'procedures',
      'contents' => json_encode($this->procedures),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->procedures as $item) {
      $item->validate();
    }
  }
}
