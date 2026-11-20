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
class UpdateDocumentChunkingOverrideResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the document or folder whose chunking override was updated.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The resulting chunking override. Null means the entity inherits from ancestors or the embedding model default.
   */
  #[JsonProperty('chunking_override', required: true)]
  public ?\ElevenLabs\Types\ChunkingOverride $chunkingOverride;

  /**
   * Whether the effective configuration changed and background reindexing was queued.
   */
  #[JsonProperty('reindex_queued', required: true)]
  public bool $reindexQueued;

  /**
   * @param array{
   *   id: string,
   *   chunkingOverride: ?\ElevenLabs\Types\ChunkingOverride,
   *   reindexQueued: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->chunkingOverride = $values['chunkingOverride'];
    $this->reindexQueued = $values['reindexQueued'];

    $this->_dirtyFields = [
      'id' => true,
      'chunking_override' => true,
      'reindex_queued' => true
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
      'name' => 'chunking_override',
      'contents' => json_encode($this->chunkingOverride),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'reindex_queued',
      'contents' => $this->reindexQueued ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->chunkingOverride?->validate();
  }
}
