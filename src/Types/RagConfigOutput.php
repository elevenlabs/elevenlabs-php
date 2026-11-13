<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RagConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled')]
  public ?bool $enabled;

  /**
   * @var ?value-of<\ElevenLabs\Types\EmbeddingModelEnum>
   */
  #[JsonProperty('embedding_model')]
  public ?string $embeddingModel;

  /**
   * Maximum vector distance of retrieved chunks.
   */
  #[JsonProperty('max_vector_distance')]
  public ?float $maxVectorDistance;

  /**
   * Maximum total length of document chunks retrieved from RAG.
   */
  #[JsonProperty('max_documents_length')]
  public ?int $maxDocumentsLength;

  /**
   * Maximum number of RAG document chunks to initially retrieve from the vector store. These are then further filtered by vector distance and total length.
   */
  #[JsonProperty('max_retrieved_rag_chunks_count')]
  public ?int $maxRetrievedRagChunksCount;

  /**
   * Number of candidates evaluated in ANN vector search. Higher number means better results, but higher latency. Minimum recommended value is 100. If disabled, the default value is used.
   */
  #[JsonProperty('num_candidates')]
  public ?int $numCandidates;

  /**
   * Custom prompt for rewriting user queries before RAG retrieval. The conversation history will be automatically appended at the end. If not set, the default prompt will be used.
   */
  #[JsonProperty('query_rewrite_prompt_override')]
  public ?string $queryRewritePromptOverride;

  /**
   * When set, the agent uses the knowledge_base tool instead of the legacy knowledge_base_rag tool. None means the agent is not opted in.
   */
  #[JsonProperty('knowledge_base_tool_info')]
  public ?\ElevenLabs\Types\KnowledgeBaseToolInfo $knowledgeBaseToolInfo;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   embeddingModel?: ?value-of<\ElevenLabs\Types\EmbeddingModelEnum>,
   *   maxVectorDistance?: ?float,
   *   maxDocumentsLength?: ?int,
   *   maxRetrievedRagChunksCount?: ?int,
   *   numCandidates?: ?int,
   *   queryRewritePromptOverride?: ?string,
   *   knowledgeBaseToolInfo?: ?\ElevenLabs\Types\KnowledgeBaseToolInfo,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->embeddingModel = $values['embeddingModel'] ?? null;
    $this->maxVectorDistance = $values['maxVectorDistance'] ?? null;
    $this->maxDocumentsLength = $values['maxDocumentsLength'] ?? null;
    $this->maxRetrievedRagChunksCount = $values['maxRetrievedRagChunksCount'] ?? null;
    $this->numCandidates = $values['numCandidates'] ?? null;
    $this->queryRewritePromptOverride = $values['queryRewritePromptOverride'] ?? null;
    $this->knowledgeBaseToolInfo = $values['knowledgeBaseToolInfo'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('embeddingModel', $values)) {
      $this->_dirtyFields['embedding_model'] = true;
    }
    if (array_key_exists('maxVectorDistance', $values)) {
      $this->_dirtyFields['max_vector_distance'] = true;
    }
    if (array_key_exists('maxDocumentsLength', $values)) {
      $this->_dirtyFields['max_documents_length'] = true;
    }
    if (array_key_exists('maxRetrievedRagChunksCount', $values)) {
      $this->_dirtyFields['max_retrieved_rag_chunks_count'] = true;
    }
    if (array_key_exists('numCandidates', $values)) {
      $this->_dirtyFields['num_candidates'] = true;
    }
    if (array_key_exists('queryRewritePromptOverride', $values)) {
      $this->_dirtyFields['query_rewrite_prompt_override'] = true;
    }
    if (array_key_exists('knowledgeBaseToolInfo', $values)) {
      $this->_dirtyFields['knowledge_base_tool_info'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->embeddingModel !== null) {
      $parts[] = [
        'name' => 'embedding_model',
        'contents' => $this->embeddingModel
      ];
    }

    if ($this->maxVectorDistance !== null) {
      $parts[] = [
        'name' => 'max_vector_distance',
        'contents' => (string) $this->maxVectorDistance
      ];
    }

    if ($this->maxDocumentsLength !== null) {
      $parts[] = [
        'name' => 'max_documents_length',
        'contents' => (string) $this->maxDocumentsLength
      ];
    }

    if ($this->maxRetrievedRagChunksCount !== null) {
      $parts[] = [
        'name' => 'max_retrieved_rag_chunks_count',
        'contents' => (string) $this->maxRetrievedRagChunksCount
      ];
    }

    if ($this->numCandidates !== null) {
      $parts[] = [
        'name' => 'num_candidates',
        'contents' => (string) $this->numCandidates
      ];
    }

    if ($this->queryRewritePromptOverride !== null) {
      $parts[] = [
        'name' => 'query_rewrite_prompt_override',
        'contents' => $this->queryRewritePromptOverride
      ];
    }

    if ($this->knowledgeBaseToolInfo !== null) {
      $parts[] = [
        'name' => 'knowledge_base_tool_info',
        'contents' => json_encode($this->knowledgeBaseToolInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber(
      $this->maxRetrievedRagChunksCount,
      'max_retrieved_rag_chunks_count',
      max: 20
    );
    Validator::validateNumber($this->numCandidates, 'num_candidates', max: 10000);
    Validator::validateString(
      $this->queryRewritePromptOverride,
      'query_rewrite_prompt_override',
      minLength: 1,
      maxLength: 1000
    );
    $this->knowledgeBaseToolInfo?->validate();
  }
}
