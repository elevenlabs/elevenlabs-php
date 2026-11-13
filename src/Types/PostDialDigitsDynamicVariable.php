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
class PostDialDigitsDynamicVariable extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The dynamic variable name to resolve
   */
  #[JsonProperty('value', required: true)]
  public string $value;

  /**
   * @var ?value-of<\ElevenLabs\Types\PostDialDigitsDynamicVariableType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   value: string,
   *   type?: ?value-of<\ElevenLabs\Types\PostDialDigitsDynamicVariableType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->value = $values['value'];
    $this->type = $values['type'] ?? 'dynamic';

    $this->_dirtyFields = [
      'value' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->value, 'value', minLength: 1);
  }
}
