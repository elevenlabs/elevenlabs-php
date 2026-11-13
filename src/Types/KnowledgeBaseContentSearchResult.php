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
class KnowledgeBaseContentSearchResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('document', required: true)]
  public \ElevenLabs\Types\KnowledgeBaseContentSearchResultDocument $document;

  /**
   * @var \ElevenLabs\Types\SearchHighlightSegment[]|null
   */
  #[JsonProperty('search_snippet'), ArrayType([\ElevenLabs\Types\SearchHighlightSegment::class])]
  public ?array $searchSnippet;

  #[JsonProperty('score', required: true)]
  public float $score;

  /**
   * @param array{
   *   document: \ElevenLabs\Types\KnowledgeBaseContentSearchResultDocument,
   *   score: float,
   *   searchSnippet?: \ElevenLabs\Types\SearchHighlightSegment[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->document = $values['document'];
    $this->searchSnippet = $values['searchSnippet'] ?? null;
    $this->score = $values['score'];

    $this->_dirtyFields = [
      'document' => true,
      'score' => true
    ];
    if (array_key_exists('searchSnippet', $values)) {
      $this->_dirtyFields['search_snippet'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'document',
      'contents' => json_encode($this->document),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->searchSnippet !== null) {
      $parts[] = [
        'name' => 'search_snippet',
        'contents' => json_encode($this->searchSnippet),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'score',
      'contents' => (string) $this->score
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->searchSnippet ?? [] as $item) {
      $item->validate();
    }
  }
}
