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
class GetDocumentChunkingOverrideResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the document or folder whose chunking settings were read.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Override stored directly on this entity. Null means every setting is inherited.
   */
  #[JsonProperty('chunking_override', required: true)]
  public ?\ElevenLabs\Types\ChunkingOverride $chunkingOverride;

  #[JsonProperty('effective_chunking_override', required: true)]
  public \ElevenLabs\Types\ChunkingOverride $effectiveChunkingOverride;

  #[JsonProperty('inherited_chunking_override', required: true)]
  public \ElevenLabs\Types\ChunkingOverride $inheritedChunkingOverride;

  /**
   * @param array{
   *   id: string,
   *   chunkingOverride: ?\ElevenLabs\Types\ChunkingOverride,
   *   effectiveChunkingOverride: \ElevenLabs\Types\ChunkingOverride,
   *   inheritedChunkingOverride: \ElevenLabs\Types\ChunkingOverride,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->chunkingOverride = $values['chunkingOverride'];
    $this->effectiveChunkingOverride = $values['effectiveChunkingOverride'];
    $this->inheritedChunkingOverride = $values['inheritedChunkingOverride'];

    $this->_dirtyFields = [
      'id' => true,
      'chunking_override' => true,
      'effective_chunking_override' => true,
      'inherited_chunking_override' => true
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
      'name' => 'effective_chunking_override',
      'contents' => json_encode($this->effectiveChunkingOverride),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'inherited_chunking_override',
      'contents' => json_encode($this->inheritedChunkingOverride),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->chunkingOverride?->validate();
    $this->effectiveChunkingOverride->validate();
    $this->inheritedChunkingOverride->validate();
  }
}
