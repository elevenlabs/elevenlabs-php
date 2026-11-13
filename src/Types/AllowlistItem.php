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
class AllowlistItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The hostname of the allowed origin
   */
  #[JsonProperty('hostname', required: true)]
  public string $hostname;

  /**
   * @param array{
   *   hostname: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->hostname = $values['hostname'];

    $this->_dirtyFields = [
      'hostname' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'hostname',
      'contents' => $this->hostname
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
