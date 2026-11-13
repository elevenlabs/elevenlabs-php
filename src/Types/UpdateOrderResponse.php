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
class UpdateOrderResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The updated order name.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   name: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
