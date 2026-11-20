<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A single branch/location extracted from a page.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RawLocationInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name')]
  public ?string $name;

  #[JsonProperty('address')]
  public ?string $address;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('operating_hours'), ArrayType(['string' => 'mixed'])]
  public ?array $operatingHours;

  /**
   * @param array{
   *   name?: ?string,
   *   address?: ?string,
   *   operatingHours?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->address = $values['address'] ?? null;
    $this->operatingHours = $values['operatingHours'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('address', $values)) {
      $this->_dirtyFields['address'] = true;
    }
    if (array_key_exists('operatingHours', $values)) {
      $this->_dirtyFields['operating_hours'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->address !== null) {
      $parts[] = [
        'name' => 'address',
        'contents' => $this->address
      ];
    }

    if ($this->operatingHours !== null) {
      $parts[] = [
        'name' => 'operating_hours',
        'contents' => json_encode($this->operatingHours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
