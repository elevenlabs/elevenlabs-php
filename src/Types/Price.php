<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Currency/amount pair.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class Price extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('amount', required: true)]
  public string $amount;

  /**
   * @var value-of<\ElevenLabs\Types\Currency>
   */
  #[JsonProperty('currency', required: true)]
  public string $currency;

  /**
   * @param array{
   *   amount: string,
   *   currency: value-of<\ElevenLabs\Types\Currency>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->amount = $values['amount'];
    $this->currency = $values['currency'];

    $this->_dirtyFields = [
      'amount' => true,
      'currency' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'amount',
      'contents' => $this->amount
    ];

    $parts[] = [
      'name' => 'currency',
      'contents' => $this->currency
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->amount,
      'amount',
      pattern: '^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$'
    );
  }
}
