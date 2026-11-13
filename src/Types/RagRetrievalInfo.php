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
class RagRetrievalInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\RagChunkMetadata[]
   */
  #[JsonProperty('chunks', required: true), ArrayType([\ElevenLabs\Types\RagChunkMetadata::class])]
  public array $chunks;

  /**
   * @var value-of<\ElevenLabs\Types\EmbeddingModelEnum>
   */
  #[JsonProperty('embedding_model', required: true)]
  public string $embeddingModel;

  #[JsonProperty('retrieval_query', required: true)]
  public string $retrievalQuery;

  #[JsonProperty('rag_latency_secs', required: true)]
  public float $ragLatencySecs;

  /**
   * @var string[]|null
   */
  #[JsonProperty('used_chunk_ids'), ArrayType(['string'])]
  public ?array $usedChunkIds;

  /**
   * @param array{
   *   chunks: \ElevenLabs\Types\RagChunkMetadata[],
   *   embeddingModel: value-of<\ElevenLabs\Types\EmbeddingModelEnum>,
   *   retrievalQuery: string,
   *   ragLatencySecs: float,
   *   usedChunkIds?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chunks = $values['chunks'];
    $this->embeddingModel = $values['embeddingModel'];
    $this->retrievalQuery = $values['retrievalQuery'];
    $this->ragLatencySecs = $values['ragLatencySecs'];
    $this->usedChunkIds = $values['usedChunkIds'] ?? null;

    $this->_dirtyFields = [
      'chunks' => true,
      'embedding_model' => true,
      'retrieval_query' => true,
      'rag_latency_secs' => true
    ];
    if (array_key_exists('usedChunkIds', $values)) {
      $this->_dirtyFields['used_chunk_ids'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chunks',
      'contents' => json_encode($this->chunks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'embedding_model',
      'contents' => $this->embeddingModel
    ];

    $parts[] = [
      'name' => 'retrieval_query',
      'contents' => $this->retrievalQuery
    ];

    $parts[] = [
      'name' => 'rag_latency_secs',
      'contents' => (string) $this->ragLatencySecs
    ];

    if ($this->usedChunkIds !== null) {
      foreach ($this->usedChunkIds ?? [] as $item) {
        $parts[] = [
          'name' => 'used_chunk_ids',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chunks as $item) {
      $item->validate();
    }
  }
}
