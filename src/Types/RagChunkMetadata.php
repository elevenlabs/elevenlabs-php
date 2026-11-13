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
class RagChunkMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('document_id', required: true)]
  public string $documentId;

  #[JsonProperty('chunk_id', required: true)]
  public string $chunkId;

  #[JsonProperty('vector_distance', required: true)]
  public float $vectorDistance;

  /**
   * @param array{
   *   documentId: string,
   *   chunkId: string,
   *   vectorDistance: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->documentId = $values['documentId'];
    $this->chunkId = $values['chunkId'];
    $this->vectorDistance = $values['vectorDistance'];

    $this->_dirtyFields = [
      'document_id' => true,
      'chunk_id' => true,
      'vector_distance' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'document_id',
      'contents' => $this->documentId
    ];

    $parts[] = [
      'name' => 'chunk_id',
      'contents' => $this->chunkId
    ];

    $parts[] = [
      'name' => 'vector_distance',
      'contents' => (string) $this->vectorDistance
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
