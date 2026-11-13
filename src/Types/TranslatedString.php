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
class TranslatedString extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @param array{
   *   value: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'value' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->value, 'value', minLength: 1);
  }
}
