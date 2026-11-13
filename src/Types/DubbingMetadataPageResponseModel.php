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
class DubbingMetadataPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\DubbingMetadataResponse[]
   */
  #[
    JsonProperty('dubs', required: true),
    ArrayType([\ElevenLabs\Types\DubbingMetadataResponse::class])
  ]
  public array $dubs;

  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   dubs: \ElevenLabs\Types\DubbingMetadataResponse[],
   *   nextCursor: ?string,
   *   hasMore: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dubs = $values['dubs'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'dubs' => true,
      'next_cursor' => true,
      'has_more' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'dubs',
      'contents' => json_encode($this->dubs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->dubs as $item) {
      $item->validate();
    }
  }
}
