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
class AgentKnowledgeBaseRagQueryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SearchStrategy>
   */
  #[JsonProperty('strategy', required: true)]
  public string $strategy;

  /**
   * Raw query used for retrieval (echoes the request query), or null for the cat and ls strategies.
   */
  #[JsonProperty('retrieval_query', required: true)]
  public ?string $retrievalQuery;

  /**
   * @var \ElevenLabs\Types\AgentKnowledgeBaseRagChunkResponseModel[]
   * Ranked chunks the agent would retrieve with semantic or keyword search, after distance and length filtering. Empty for the cat and ls strategies.
   */
  #[
    JsonProperty('chunks', required: true),
    ArrayType([\ElevenLabs\Types\AgentKnowledgeBaseRagChunkResponseModel::class])
  ]
  public array $chunks;

  /**
   * Document read by the cat strategy, or null when the reference matched no document or another strategy ran.
   */
  #[JsonProperty('document')]
  public ?\ElevenLabs\Types\AgentKnowledgeBaseRagDocumentResponseModel $document;

  /**
   * Entries listed by the ls strategy, or null when the reference matched nothing or another strategy ran.
   */
  #[JsonProperty('listing')]
  public ?\ElevenLabs\Types\AgentKnowledgeBaseRagListingResponseModel $listing;

  /**
   * @param array{
   *   strategy: value-of<\ElevenLabs\Types\SearchStrategy>,
   *   retrievalQuery: ?string,
   *   chunks: \ElevenLabs\Types\AgentKnowledgeBaseRagChunkResponseModel[],
   *   document?: ?\ElevenLabs\Types\AgentKnowledgeBaseRagDocumentResponseModel,
   *   listing?: ?\ElevenLabs\Types\AgentKnowledgeBaseRagListingResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->strategy = $values['strategy'];
    $this->retrievalQuery = $values['retrievalQuery'];
    $this->chunks = $values['chunks'];
    $this->document = $values['document'] ?? null;
    $this->listing = $values['listing'] ?? null;

    $this->_dirtyFields = [
      'strategy' => true,
      'retrieval_query' => true,
      'chunks' => true
    ];
    if (array_key_exists('document', $values)) {
      $this->_dirtyFields['document'] = true;
    }
    if (array_key_exists('listing', $values)) {
      $this->_dirtyFields['listing'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'strategy',
      'contents' => $this->strategy
    ];

    $parts[] = [
      'name' => 'retrieval_query',
      'contents' => $this->retrievalQuery
    ];

    $parts[] = [
      'name' => 'chunks',
      'contents' => json_encode($this->chunks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->document !== null) {
      $parts[] = [
        'name' => 'document',
        'contents' => json_encode($this->document),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->listing !== null) {
      $parts[] = [
        'name' => 'listing',
        'contents' => json_encode($this->listing),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->chunks as $item) {
      $item->validate();
    }
    $this->document?->validate();
    $this->listing?->validate();
  }
}
