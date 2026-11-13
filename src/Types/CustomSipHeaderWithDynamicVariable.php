<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Custom SIP header for phone transfers with a dynamic variable reference.
 * The value is a variable name that will be resolved at runtime.
 * Value is not validated here since it will be substituted with actual value later.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomSipHeaderWithDynamicVariable extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The dynamic variable name to resolve
   */
  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @var value-of<\ElevenLabs\Types\CustomSipHeaderWithDynamicVariableType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The SIP header name (e.g., 'X-Customer-ID')
   */
  #[JsonProperty('key', required: true)]
  public string $key;

  /**
   * @param array{
   *   value: string,
   *   type: value-of<\ElevenLabs\Types\CustomSipHeaderWithDynamicVariableType>,
   *   key: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->value = $values['value'];
    $this->type = $values['type'];
    $this->key = $values['key'];

    $this->_dirtyFields = [
      'value' => true,
      'type' => true,
      'key' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'key',
      'contents' => $this->key
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->value, 'value', minLength: 1);
    Validator::validateString(
      $this->key,
      'key',
      minLength: 1,
      maxLength: 64,
      pattern: '^[A-Za-z0-9]+(-[A-Za-z0-9]+)*$'
    );
  }
}
