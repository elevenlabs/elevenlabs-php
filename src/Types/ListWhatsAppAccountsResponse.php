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
class ListWhatsAppAccountsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetWhatsAppAccountResponse[]
   */
  #[
    JsonProperty('items', required: true),
    ArrayType([\ElevenLabs\Types\GetWhatsAppAccountResponse::class])
  ]
  public array $items;

  /**
   * @param array{
   *   items: \ElevenLabs\Types\GetWhatsAppAccountResponse[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->items = $values['items'];

    $this->_dirtyFields = [
      'items' => true
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

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->items as $item) {
      $item->validate();
    }
  }
}
