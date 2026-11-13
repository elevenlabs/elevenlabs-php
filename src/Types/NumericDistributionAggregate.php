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
class NumericDistributionAggregate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('count')]
  public ?int $count;

  #[JsonProperty('sum')]
  public ?float $sum;

  #[JsonProperty('min')]
  public ?float $min;

  #[JsonProperty('max')]
  public ?float $max;

  /**
   * @param array{
   *   count?: ?int,
   *   sum?: ?float,
   *   min?: ?float,
   *   max?: ?float,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->count = $values['count'] ?? null;
    $this->sum = $values['sum'] ?? null;
    $this->min = $values['min'] ?? null;
    $this->max = $values['max'] ?? null;

    if (array_key_exists('count', $values)) {
      $this->_dirtyFields['count'] = true;
    }
    if (array_key_exists('sum', $values)) {
      $this->_dirtyFields['sum'] = true;
    }
    if (array_key_exists('min', $values)) {
      $this->_dirtyFields['min'] = true;
    }
    if (array_key_exists('max', $values)) {
      $this->_dirtyFields['max'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->count !== null) {
      $parts[] = [
        'name' => 'count',
        'contents' => (string) $this->count
      ];
    }

    if ($this->sum !== null) {
      $parts[] = [
        'name' => 'sum',
        'contents' => (string) $this->sum
      ];
    }

    if ($this->min !== null) {
      $parts[] = [
        'name' => 'min',
        'contents' => (string) $this->min
      ];
    }

    if ($this->max !== null) {
      $parts[] = [
        'name' => 'max',
        'contents' => (string) $this->max
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
