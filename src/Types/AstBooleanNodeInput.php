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
class AstBooleanNodeInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstBooleanNodeInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Value of this literal.
   */
  #[JsonProperty('value', required: true)]
  public bool $value;

  /**
   * @param array{
   *   value: bool,
   *   type?: ?value-of<\ElevenLabs\Types\AstBooleanNodeInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'boolean_literal';
    $this->value = $values['value'];

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
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'value',
      'contents' => $this->value ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
