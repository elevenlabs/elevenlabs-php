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
class WhatsAppTemplateLocationParamDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('latitude', required: true)]
  public string $latitude;

  #[JsonProperty('longitude', required: true)]
  public string $longitude;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('address', required: true)]
  public string $address;

  /**
   * @param array{
   *   latitude: string,
   *   longitude: string,
   *   name: string,
   *   address: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->latitude = $values['latitude'];
    $this->longitude = $values['longitude'];
    $this->name = $values['name'];
    $this->address = $values['address'];

    $this->_dirtyFields = [
      'latitude' => true,
      'longitude' => true,
      'name' => true,
      'address' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'latitude',
      'contents' => $this->latitude
    ];

    $parts[] = [
      'name' => 'longitude',
      'contents' => $this->longitude
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'address',
      'contents' => $this->address
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
