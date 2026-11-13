<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AllowedValues extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Name of a dynamic variable that must resolve to a JSON array of permitted values, e.g. ["ws_alpha", "ws_beta"]. System variables work only if they resolve to a list.
   */
  #[JsonProperty('dynamic_variable', required: true)]
  public string $dynamicVariable;

  /**
   * @param array{
   *   dynamicVariable: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dynamicVariable = $values['dynamicVariable'];

    $this->_dirtyFields = [
      'dynamic_variable' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'dynamic_variable',
      'contents' => $this->dynamicVariable
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->dynamicVariable, 'dynamic_variable', minLength: 1);
  }
}
