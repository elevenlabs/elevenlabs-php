<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A single item extracted from a page — could be a service, person, product, or asset.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RawItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('price')]
  public ?float $price;

  #[JsonProperty('duration_minutes')]
  public ?int $durationMinutes;

  /**
   * @param array{
   *   name: string,
   *   description?: ?string,
   *   price?: ?float,
   *   durationMinutes?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->price = $values['price'] ?? null;
    $this->durationMinutes = $values['durationMinutes'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('price', $values)) {
      $this->_dirtyFields['price'] = true;
    }
    if (array_key_exists('durationMinutes', $values)) {
      $this->_dirtyFields['duration_minutes'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->price !== null) {
      $parts[] = [
        'name' => 'price',
        'contents' => (string) $this->price
      ];
    }

    if ($this->durationMinutes !== null) {
      $parts[] = [
        'name' => 'duration_minutes',
        'contents' => (string) $this->durationMinutes
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
