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
class PaginatedResultAgentMergeProposalResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentMergeProposalResponse[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([\ElevenLabs\Types\AgentMergeProposalResponse::class])
  ]
  public array $results;

  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   results: \ElevenLabs\Types\AgentMergeProposalResponse[],
   *   nextCursor: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->results = $values['results'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'results' => true,
      'next_cursor' => true
    ];
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
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

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
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
