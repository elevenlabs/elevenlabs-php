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
class GetTestInvocationsPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('meta')]
  public ?\ElevenLabs\Types\ListResponseMeta $meta;

  /**
   * @var \ElevenLabs\Types\TestInvocationSummaryResponseModel[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([\ElevenLabs\Types\TestInvocationSummaryResponseModel::class])
  ]
  public array $results;

  /**
   * Cursor for the next page of results
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether there are more results available
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   results: \ElevenLabs\Types\TestInvocationSummaryResponseModel[],
   *   hasMore: bool,
   *   meta?: ?\ElevenLabs\Types\ListResponseMeta,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->meta = $values['meta'] ?? null;
    $this->results = $values['results'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'results' => true,
      'has_more' => true
    ];
    if (array_key_exists('meta', $values)) {
      $this->_dirtyFields['meta'] = true;
    }
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->meta !== null) {
      $parts[] = [
        'name' => 'meta',
        'contents' => json_encode($this->meta),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->meta?->validate();
    foreach ($this->results as $item) {
      $item->validate();
    }
  }
}
