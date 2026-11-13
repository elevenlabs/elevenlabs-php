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
class ProcedureDraftRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Procedure ID
   */
  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  #[JsonProperty('version_id')]
  public mixed $versionId;

  /**
   * @param array{
   *   procedureId: string,
   *   versionId?: mixed,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedureId = $values['procedureId'];
    $this->versionId = $values['versionId'] ?? null;

    $this->_dirtyFields = [
      'procedure_id' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => json_encode($this->versionId),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
