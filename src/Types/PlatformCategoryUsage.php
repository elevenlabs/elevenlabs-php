<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Accumulated charge for a single :class:`PlatformCategory`.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PlatformCategoryUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('credits')]
  public ?int $credits;

  #[JsonProperty('price')]
  public ?float $price;

  #[JsonProperty('quantity')]
  public ?float $quantity;

  /**
   * @param array{
   *   credits?: ?int,
   *   price?: ?float,
   *   quantity?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->credits = $values['credits'] ?? null;
    $this->price = $values['price'] ?? null;
    $this->quantity = $values['quantity'] ?? null;

    if (array_key_exists('credits', $values)) {
      $this->_dirtyFields['credits'] = true;
    }
    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
    }
    if (array_key_exists('quantity', $values)) {
      $this->_dirtyFields['quantity'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->credits !== null) {
      $parts[] = [
        'name' => 'credits',
        'contents' => (string) $this->credits
      ];
    }

    if ($this->price !== null) {
      $parts[] = [
        'name' => 'price',
        'contents' => (string) $this->price
      ];
    }

    if ($this->quantity !== null) {
      $parts[] = [
        'name' => 'quantity',
        'contents' => (string) $this->quantity
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
