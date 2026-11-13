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
class RegionalProcessingSurchargeInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The surcharge multiplier applied to this model's pricing (e.g. 1.1 for a 10% surcharge).
   */
  #[JsonProperty('multiplier', required: true)]
  public float $multiplier;

  /**
   * @param array{
   *   multiplier: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->multiplier = $values['multiplier'];

    $this->_dirtyFields = [
      'multiplier' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'multiplier',
      'contents' => (string) $this->multiplier
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
