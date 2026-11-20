<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateDocumentChunkingOverrideRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * RAG chunking override for a document or folder. Null clears the override so ancestors and embedding model defaults apply.
   */
  #[JsonProperty('chunking_override', required: true)]
  public ?\ElevenLabs\Types\ChunkingOverrideRequestModel $chunkingOverride;

  /**
   * @param array{
   *   chunkingOverride: ?\ElevenLabs\Types\ChunkingOverrideRequestModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chunkingOverride = $values['chunkingOverride'];

    $this->_dirtyFields = [
      'chunking_override' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chunking_override',
      'contents' => json_encode($this->chunkingOverride),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->chunkingOverride?->validate();
  }
}
