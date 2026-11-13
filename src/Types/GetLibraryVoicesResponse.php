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
class GetLibraryVoicesResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\LibraryVoiceResponse[]
   * The list of shared voices
   */
  #[
    JsonProperty('voices', required: true),
    ArrayType([\ElevenLabs\Types\LibraryVoiceResponse::class])
  ]
  public array $voices;

  /**
   * Whether there are more shared voices in subsequent pages.
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * The total number of shared voices matching the query.
   */
  #[JsonProperty('total_count')]
  public ?int $totalCount;

  #[JsonProperty('last_sort_id')]
  public ?string $lastSortId;

  /**
   * @param array{
   *   voices: \ElevenLabs\Types\LibraryVoiceResponse[],
   *   hasMore: bool,
   *   totalCount?: ?int,
   *   lastSortId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voices = $values['voices'];
    $this->hasMore = $values['hasMore'];
    $this->totalCount = $values['totalCount'] ?? null;
    $this->lastSortId = $values['lastSortId'] ?? null;

    $this->_dirtyFields = [
      'voices' => true,
      'has_more' => true
    ];
    if (array_key_exists('totalCount', $values)) {
      $this->_dirtyFields['total_count'] = true;
    }
    if (array_key_exists('lastSortId', $values)) {
      $this->_dirtyFields['last_sort_id'] = true;
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

    if ($this->totalCount !== null) {
      $parts[] = [
        'name' => 'total_count',
        'contents' => (string) $this->totalCount
      ];
    }

    if ($this->lastSortId !== null) {
      $parts[] = [
        'name' => 'last_sort_id',
        'contents' => $this->lastSortId
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
