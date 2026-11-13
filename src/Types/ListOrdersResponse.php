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
class ListOrdersResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\OrderSummary[]
   * The list of orders matching the query.
   */
  #[JsonProperty('orders', required: true), ArrayType([\ElevenLabs\Types\OrderSummary::class])]
  public array $orders;

  /**
   * @param array{
   *   orders: \ElevenLabs\Types\OrderSummary[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->orders = $values['orders'];

    $this->_dirtyFields = [
      'orders' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'orders',
      'contents' => json_encode($this->orders),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->orders as $item) {
      $item->validate();
    }
  }
}
