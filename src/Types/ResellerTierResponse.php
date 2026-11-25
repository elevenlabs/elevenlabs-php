<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A tier you can sell.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResellerTierResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('tier_id', required: true)]
  public string $tierId;

  #[JsonProperty('display_name', required: true)]
  public string $displayName;

  /**
   * @var value-of<\ElevenLabs\Types\ResellerTierResponseCurrency>
   * What the prices are in. The same for every tier on a ladder.
   */
  #[JsonProperty('currency', required: true)]
  public string $currency;

  /**
   * A tier's prices and the limits shown on its tier card.
   */
  #[JsonProperty('tier_economics', required: true)]
  public \ElevenLabs\Types\ResellerTierEconomics $tierEconomics;

  /**
   * @param array{
   *   tierId: string,
   *   displayName: string,
   *   currency: value-of<\ElevenLabs\Types\ResellerTierResponseCurrency>,
   *   tierEconomics: \ElevenLabs\Types\ResellerTierEconomics,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tierId = $values['tierId'];
    $this->displayName = $values['displayName'];
    $this->currency = $values['currency'];
    $this->tierEconomics = $values['tierEconomics'];

    $this->_dirtyFields = [
      'tier_id' => true,
      'display_name' => true,
      'currency' => true,
      'tier_economics' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tier_id',
      'contents' => $this->tierId
    ];

    $parts[] = [
      'name' => 'display_name',
      'contents' => $this->displayName
    ];

    $parts[] = [
      'name' => 'currency',
      'contents' => $this->currency
    ];

    $parts[] = [
      'name' => 'tier_economics',
      'contents' => json_encode($this->tierEconomics),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->tierEconomics->validate();
  }
}
