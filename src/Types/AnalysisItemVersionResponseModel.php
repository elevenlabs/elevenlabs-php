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
class AnalysisItemVersionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('version_number', required: true)]
  public int $versionNumber;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('definition', required: true)]
  public \ElevenLabs\Types\AnalysisItemVersionResponseModelDefinition $definition;

  /**
   * @param array{
   *   id: string,
   *   versionNumber: int,
   *   createdAtUnixSecs: int,
   *   definition: \ElevenLabs\Types\AnalysisItemVersionResponseModelDefinition,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->versionNumber = $values['versionNumber'];
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->definition = $values['definition'];

    $this->_dirtyFields = [
      'id' => true,
      'version_number' => true,
      'created_at_unix_secs' => true,
      'definition' => true
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
      'name' => 'version_number',
      'contents' => (string) $this->versionNumber
    ];

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'definition',
      'contents' => json_encode($this->definition),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
