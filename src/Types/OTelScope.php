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
class OTelScope extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('version', required: true)]
  public string $version;

  /**
   * @param array{
   *   name: string,
   *   version: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->version = $values['version'];

    $this->_dirtyFields = [
      'name' => true,
      'version' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'version',
      'contents' => $this->version
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
