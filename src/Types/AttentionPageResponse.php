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
class AttentionPageResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AttentionView[]
   */
  #[JsonProperty('attention', required: true), ArrayType([\ElevenLabs\Types\AttentionView::class])]
  public array $attention;

  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   attention: \ElevenLabs\Types\AttentionView[],
   *   nextCursor: ?string,
   *   hasMore: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->attention = $values['attention'];
    $this->nextCursor = $values['nextCursor'];
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'attention' => true,
      'next_cursor' => true,
      'has_more' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'attention',
      'contents' => json_encode($this->attention),
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
    foreach ($this->attention as $item) {
      $item->validate();
    }
  }
}
