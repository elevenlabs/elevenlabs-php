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
class GetAudioIsolationHistoryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AudioIsolationHistoryItemResponseModel[]
   */
  #[
    JsonProperty('items', required: true),
    ArrayType([\ElevenLabs\Types\AudioIsolationHistoryItemResponseModel::class])
  ]
  public array $items;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   items: \ElevenLabs\Types\AudioIsolationHistoryItemResponseModel[],
   *   hasMore: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->items = $values['items'];
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'items' => true,
      'has_more' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'items',
      'contents' => json_encode($this->items),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->items as $item) {
      $item->validate();
    }
  }
}
