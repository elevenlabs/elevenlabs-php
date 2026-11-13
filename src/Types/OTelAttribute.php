<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OTelAttribute extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('key', required: true)]
  public string $key;

  /**
   * @var array<string, string|bool|float>
   */
  #[
    JsonProperty('value', required: true),
    ArrayType(['string' => new Union('string', 'bool', 'float')])
  ]
  public array $value;

  /**
   * @param array{
   *   key: string,
   *   value: array<string, string|bool|float>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->key = $values['key'];
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'key' => true,
      'value' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'key',
      'contents' => $this->key
    ];

    $parts[] = [
      'name' => 'value',
      'contents' => json_encode($this->value),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
