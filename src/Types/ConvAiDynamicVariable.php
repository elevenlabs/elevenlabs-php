<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Used to reference a dynamic variable.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConvAiDynamicVariable extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('variable_name', required: true)]
  public string $variableName;

  /**
   * @param array{
   *   variableName: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->variableName = $values['variableName'];

    $this->_dirtyFields = [
      'variable_name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'variable_name',
      'contents' => $this->variableName
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
