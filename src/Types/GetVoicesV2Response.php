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
class GetVoicesV2Response extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\Voice[]
   * The list of voices matching the query.
   */
  #[JsonProperty('voices', required: true), ArrayType([\ElevenLabs\Types\Voice::class])]
  public array $voices;

  /**
   * Indicates whether there are more voices available in subsequent pages. Use this flag (and next_page_token) for reliable pagination instead of relying on total_count.
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * The total count of voices matching the query. This value is a live snapshot that reflects the current state of the database and may change between requests as users create, modify, or delete voices. For reliable pagination, use the has_more flag instead of relying on this value. Only request this field when you actually need the total count (e.g., for display purposes), as calculating it incurs a performance cost.
   */
  #[JsonProperty('total_count', required: true)]
  public int $totalCount;

  /**
   * Token to retrieve the next page of results. Pass this value to the next request to continue pagination. Null if there are no more results.
   */
  #[JsonProperty('next_page_token')]
  public ?string $nextPageToken;

  /**
   * @param array{
   *   voices: \ElevenLabs\Types\Voice[],
   *   hasMore: bool,
   *   totalCount: int,
   *   nextPageToken?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voices = $values['voices'];
    $this->hasMore = $values['hasMore'];
    $this->totalCount = $values['totalCount'];
    $this->nextPageToken = $values['nextPageToken'] ?? null;

    $this->_dirtyFields = [
      'voices' => true,
      'has_more' => true,
      'total_count' => true
    ];
    if (array_key_exists('nextPageToken', $values)) {
      $this->_dirtyFields['next_page_token'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voices',
      'contents' => json_encode($this->voices),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'total_count',
      'contents' => (string) $this->totalCount
    ];

    if ($this->nextPageToken !== null) {
      $parts[] = [
        'name' => 'next_page_token',
        'contents' => $this->nextPageToken
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->voices as $item) {
      $item->validate();
    }
  }
}
