<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A set of fields that must all be present to satisfy this constraint.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RequiredConstraint extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('required', required: true), ArrayType(['string'])]
  public array $required;

  /**
   * @param array{
   *   required: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->required = $values['required'];

    $this->_dirtyFields = [
      'required' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->required as $item) {
      $parts[] = [
        'name' => 'required',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
