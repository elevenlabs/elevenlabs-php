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
class UpsertOrderItemResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('item_id', required: true)]
  public string $itemId;

  /**
   * The quoted price for this item.
   */
  #[JsonProperty('quote')]
  public ?\ElevenLabs\Types\QuoteInfo $quote;

  /**
   * @param array{
   *   itemId: string,
   *   quote?: ?\ElevenLabs\Types\QuoteInfo,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->itemId = $values['itemId'];
    $this->quote = $values['quote'] ?? null;

    $this->_dirtyFields = [
      'item_id' => true
    ];
    if (array_key_exists('quote', $values)) {
      $this->_dirtyFields['quote'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'item_id',
      'contents' => $this->itemId
    ];

    if ($this->quote !== null) {
      $parts[] = [
        'name' => 'quote',
        'contents' => json_encode($this->quote),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->itemId, 'item_id', pattern: '^proditem_[a-z0-9]{26}$');
    $this->quote?->validate();
  }
}
