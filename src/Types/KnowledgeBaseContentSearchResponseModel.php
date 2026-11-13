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
class KnowledgeBaseContentSearchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseContentSearchResult[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseContentSearchResult::class])
  ]
  public array $results;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   results: \ElevenLabs\Types\KnowledgeBaseContentSearchResult[],
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->results = $values['results'];
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'results' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'results',
      'contents' => json_encode($this->results),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->results as $item) {
      $item->validate();
    }
  }
}
