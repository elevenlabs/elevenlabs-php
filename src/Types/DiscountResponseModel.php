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
class DiscountResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The discount applied to the invoice. E.g. [20.0f] for 20% off.
   */
  #[JsonProperty('discount_percent_off')]
  public ?float $discountPercentOff;

  /**
   * The discount applied to the invoice. E.g. [20.0f] for 20 cents off.
   */
  #[JsonProperty('discount_amount_off')]
  public ?float $discountAmountOff;

  /**
   * @param array{
   *   discountPercentOff?: ?float,
   *   discountAmountOff?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->discountPercentOff = $values['discountPercentOff'] ?? null;
    $this->discountAmountOff = $values['discountAmountOff'] ?? null;

    if (array_key_exists('discountPercentOff', $values)) {
      $this->_dirtyFields['discount_percent_off'] = true;
    }
    if (array_key_exists('discountAmountOff', $values)) {
      $this->_dirtyFields['discount_amount_off'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->discountPercentOff !== null) {
      $parts[] = [
        'name' => 'discount_percent_off',
        'contents' => (string) $this->discountPercentOff
      ];
    }

    if ($this->discountAmountOff !== null) {
      $parts[] = [
        'name' => 'discount_amount_off',
        'contents' => (string) $this->discountAmountOff
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
