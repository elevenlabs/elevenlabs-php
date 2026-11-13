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
class ProcedureVersionRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Procedure ID
   */
  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  /**
   * Version ID of the procedure version.
   */
  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  /**
   * @param array{
   *   procedureId: string,
   *   versionId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedureId = $values['procedureId'];
    $this->versionId = $values['versionId'];

    $this->_dirtyFields = [
      'procedure_id' => true,
      'version_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
