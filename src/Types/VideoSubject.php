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
class VideoSubject extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @param array{
   *   name: string,
   *   description: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->description = $values['description'];

    $this->_dirtyFields = [
      'name' => true,
      'description' => true
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
      'name' => 'description',
      'contents' => $this->description
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
