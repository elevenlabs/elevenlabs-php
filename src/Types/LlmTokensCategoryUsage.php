<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmTokensCategoryUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Number of tokens in this category.
   */
  #[JsonProperty('tokens')]
  public ?int $tokens;

  /**
   * Price of these tokens in USD.
   */
  #[JsonProperty('price')]
  public ?float $price;

  /**
   * @param array{
   *   tokens?: ?int,
   *   price?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->tokens = $values['tokens'] ?? null;
    $this->price = $values['price'] ?? null;

    if (array_key_exists('tokens', $values)) {
      $this->_dirtyFields['tokens'] = true;
    }
    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->tokens !== null) {
      $parts[] = [
        'name' => 'tokens',
        'contents' => (string) $this->tokens
      ];
    }

    if ($this->price !== null) {
      $parts[] = [
        'name' => 'price',
        'contents' => (string) $this->price
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
