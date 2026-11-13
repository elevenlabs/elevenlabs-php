<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpsertOrderItemRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('item', required: true)]
  public \ElevenLabs\Types\OrderItemRequestInput $item;

  /**
   * The ID of an existing item to update. Omit to create a new item.
   */
  #[JsonProperty('item_id')]
  public ?string $itemId;

  /**
   * @param array{
   *   item: \ElevenLabs\Types\OrderItemRequestInput,
   *   itemId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->item = $values['item'];
    $this->itemId = $values['itemId'] ?? null;

    $this->_dirtyFields = [
      'item' => true
    ];
    if (array_key_exists('itemId', $values)) {
      $this->_dirtyFields['item_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'item',
      'contents' => json_encode($this->item),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->itemId !== null) {
      $parts[] = [
        'name' => 'item_id',
        'contents' => $this->itemId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->itemId, 'item_id', pattern: '^proditem_[a-z0-9]{26}$');
  }
}
