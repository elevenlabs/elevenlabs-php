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
class ModelRatesResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The cost multiplier for characters.
   */
  #[JsonProperty('character_cost_multiplier', required: true)]
  public float $characterCostMultiplier;

  /**
   * Discount multiplier applied to cost estimates. Defaults to 1.0 (no discount).
   */
  #[JsonProperty('cost_discount_multiplier')]
  public ?float $costDiscountMultiplier;

  /**
   * @param array{
   *   characterCostMultiplier: float,
   *   costDiscountMultiplier?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->characterCostMultiplier = $values['characterCostMultiplier'];
    $this->costDiscountMultiplier = $values['costDiscountMultiplier'] ?? null;

    $this->_dirtyFields = [
      'character_cost_multiplier' => true
    ];
    if (array_key_exists('costDiscountMultiplier', $values)) {
      $this->_dirtyFields['cost_discount_multiplier'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'character_cost_multiplier',
      'contents' => (string) $this->characterCostMultiplier
    ];

    if ($this->costDiscountMultiplier !== null) {
      $parts[] = [
        'name' => 'cost_discount_multiplier',
        'contents' => (string) $this->costDiscountMultiplier
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
