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
class ResellerUpcomingPaymentsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ResellerUpcomingPayment[]
   */
  #[
    JsonProperty('payments', required: true),
    ArrayType([\ElevenLabs\Types\ResellerUpcomingPayment::class])
  ]
  public array $payments;

  /**
   * @param array{
   *   payments: \ElevenLabs\Types\ResellerUpcomingPayment[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->payments = $values['payments'];

    $this->_dirtyFields = [
      'payments' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'payments',
      'contents' => json_encode($this->payments),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->payments as $item) {
      $item->validate();
    }
  }
}
