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
class KnowledgeBaseRagToolResultModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolResultModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * Number of relevant chunks retrieved
   */
  #[JsonProperty('chunk_count')]
  public ?int $chunkCount;

  /**
   * Human-readable status for the LLM about the search results
   */
  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseRagChunkModel[]|null
   * Retrieved chunks; populated only in the rag-result-in-tool-result mode
   */
  #[JsonProperty('chunks'), ArrayType([\ElevenLabs\Types\KnowledgeBaseRagChunkModel::class])]
  public ?array $chunks;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolResultModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolStatus>,
   *   chunkCount?: ?int,
   *   message?: ?string,
   *   chunks?: \ElevenLabs\Types\KnowledgeBaseRagChunkModel[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'knowledge_base_rag_success';
    $this->status = $values['status'] ?? null;
    $this->chunkCount = $values['chunkCount'] ?? null;
    $this->message = $values['message'] ?? null;
    $this->chunks = $values['chunks'] ?? null;

    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('chunkCount', $values)) {
      $this->_dirtyFields['chunk_count'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
    if (array_key_exists('chunks', $values)) {
      $this->_dirtyFields['chunks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->chunkCount !== null) {
      $parts[] = [
        'name' => 'chunk_count',
        'contents' => (string) $this->chunkCount
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    if ($this->chunks !== null) {
      $parts[] = [
        'name' => 'chunks',
        'contents' => json_encode($this->chunks),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chunks ?? [] as $item) {
      $item->validate();
    }
  }
}
