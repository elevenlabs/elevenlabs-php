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
class QuoteInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The quoted price for this item in USD. Use the order's total_amount_usd for the combined order total.
   */
  #[JsonProperty('amount_usd', required: true)]
  public float $amountUsd;

  /**
   * @param array{
   *   amountUsd: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->amountUsd = $values['amountUsd'];

    $this->_dirtyFields = [
      'amount_usd' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'amount_usd',
      'contents' => (string) $this->amountUsd
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
