<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AgentKnowledgeBaseRagQueryRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SearchStrategy>
   */
  #[JsonProperty('strategy')]
  public ?string $strategy;

  /**
   * Query to search the knowledge base for. Required for the semantic and keyword strategies.
   */
  #[JsonProperty('query')]
  public ?string $query;

  /**
   * @var string[]|null
   * IDs or names of knowledge base documents or folders. Semantic and keyword search only search these entries; cat reads the single document given; ls lists the single folder given, or the top level of the knowledge base when omitted.
   */
  #[JsonProperty('documents'), ArrayType(['string'])]
  public ?array $documents;

  /**
   * When true (the default), retrieval uses the agent's own RAG settings, reproducing exactly what the agent would retrieve. Set to false to retrieve with neutral default RAG settings instead (the agent's embedding model is always kept, since it determines which vector index exists). Useful for auditing the knowledge base independently of how a particular agent is tuned.
   */
  #[JsonProperty('use_agent_defaults')]
  public ?bool $useAgentDefaults;

  /**
   * Optional maximum total character length of document chunks returned. Overrides the selected RAG settings for this query only.
   */
  #[JsonProperty('max_documents_length')]
  public ?int $maxDocumentsLength;

  /**
   * Optional maximum number of document chunks retrieved. Overrides the selected RAG settings for this query only.
   */
  #[JsonProperty('max_retrieved_rag_chunks_count')]
  public ?int $maxRetrievedRagChunksCount;

  /**
   * @param array{
   *   strategy?: ?value-of<\ElevenLabs\Types\SearchStrategy>,
   *   query?: ?string,
   *   documents?: string[]|null,
   *   useAgentDefaults?: ?bool,
   *   maxDocumentsLength?: ?int,
   *   maxRetrievedRagChunksCount?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->strategy = $values['strategy'] ?? null;
    $this->query = $values['query'] ?? null;
    $this->documents = $values['documents'] ?? null;
    $this->useAgentDefaults = $values['useAgentDefaults'] ?? null;
    $this->maxDocumentsLength = $values['maxDocumentsLength'] ?? null;
    $this->maxRetrievedRagChunksCount = $values['maxRetrievedRagChunksCount'] ?? null;

    if (array_key_exists('strategy', $values)) {
      $this->_dirtyFields['strategy'] = true;
    }
    if (array_key_exists('query', $values)) {
      $this->_dirtyFields['query'] = true;
    }
    if (array_key_exists('documents', $values)) {
      $this->_dirtyFields['documents'] = true;
    }
    if (array_key_exists('useAgentDefaults', $values)) {
      $this->_dirtyFields['use_agent_defaults'] = true;
    }
    if (array_key_exists('maxDocumentsLength', $values)) {
      $this->_dirtyFields['max_documents_length'] = true;
    }
    if (array_key_exists('maxRetrievedRagChunksCount', $values)) {
      $this->_dirtyFields['max_retrieved_rag_chunks_count'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->strategy !== null) {
      $parts[] = [
        'name' => 'strategy',
        'contents' => $this->strategy
      ];
    }

    if ($this->query !== null) {
      $parts[] = [
        'name' => 'query',
        'contents' => $this->query
      ];
    }

    if ($this->documents !== null) {
      foreach ($this->documents ?? [] as $item) {
        $parts[] = [
          'name' => 'documents',
          'contents' => $item
        ];
      }
    }

    if ($this->useAgentDefaults !== null) {
      $parts[] = [
        'name' => 'use_agent_defaults',
        'contents' => $this->useAgentDefaults ? 'true' : 'false'
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->query, 'query', minLength: 1);
    Validator::validateArray($this->documents, 'documents', maxItems: 100);
    Validator::validateNumber($this->maxDocumentsLength, 'max_documents_length', max: 50000);
    Validator::validateNumber(
      $this->maxRetrievedRagChunksCount,
      'max_retrieved_rag_chunks_count',
      max: 20
    );
  }
}
