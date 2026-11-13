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
class KnowledgeBaseRagChunkModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('chunk_id', required: true)]
  public string $chunkId;

  #[JsonProperty('document_id', required: true)]
  public string $documentId;

  #[JsonProperty('content', required: true)]
  public string $content;

  /**
   * @param array{
   *   chunkId: string,
   *   documentId: string,
   *   content: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chunkId = $values['chunkId'];
    $this->documentId = $values['documentId'];
    $this->content = $values['content'];

    $this->_dirtyFields = [
      'chunk_id' => true,
      'document_id' => true,
      'content' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chunk_id',
      'contents' => $this->chunkId
    ];

    $parts[] = [
      'name' => 'document_id',
      'contents' => $this->documentId
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
