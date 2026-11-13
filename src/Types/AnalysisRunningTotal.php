<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Cumulative LLM cost of running post-call analysis on this conversation.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AnalysisRunningTotal extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('price')]
  public ?float $price;

  #[JsonProperty('charge')]
  public ?int $charge;

  #[JsonProperty('runs')]
  public ?int $runs;

  /**
   * @var array<string, float>|null
   */
  #[JsonProperty('price_per_feature'), ArrayType(['string' => 'float'])]
  public ?array $pricePerFeature;

  /**
   * @var array<string, int>|null
   */
  #[JsonProperty('charge_per_feature'), ArrayType(['string' => 'integer'])]
  public ?array $chargePerFeature;

  /**
   * @param array{
   *   price?: ?float,
   *   charge?: ?int,
   *   runs?: ?int,
   *   pricePerFeature?: array<string, float>|null,
   *   chargePerFeature?: array<string, int>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->price = $values['price'] ?? null;
    $this->charge = $values['charge'] ?? null;
    $this->runs = $values['runs'] ?? null;
    $this->pricePerFeature = $values['pricePerFeature'] ?? null;
    $this->chargePerFeature = $values['chargePerFeature'] ?? null;

    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
    }
    if (array_key_exists('charge', $values)) {
      $this->_dirtyFields['charge'] = true;
    }
    if (array_key_exists('runs', $values)) {
      $this->_dirtyFields['runs'] = true;
    }
    if (array_key_exists('pricePerFeature', $values)) {
      $this->_dirtyFields['price_per_feature'] = true;
    }
    if (array_key_exists('chargePerFeature', $values)) {
      $this->_dirtyFields['charge_per_feature'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->price !== null) {
      $parts[] = [
        'name' => 'price',
        'contents' => (string) $this->price
      ];
    }

    if ($this->charge !== null) {
      $parts[] = [
        'name' => 'charge',
        'contents' => (string) $this->charge
      ];
    }

    if ($this->runs !== null) {
      $parts[] = [
        'name' => 'runs',
        'contents' => (string) $this->runs
      ];
    }

    if ($this->pricePerFeature !== null) {
      $parts[] = [
        'name' => 'price_per_feature',
        'contents' => json_encode($this->pricePerFeature),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->chargePerFeature !== null) {
      $parts[] = [
        'name' => 'charge_per_feature',
        'contents' => json_encode($this->chargePerFeature),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
