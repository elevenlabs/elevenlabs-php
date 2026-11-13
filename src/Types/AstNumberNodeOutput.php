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
class AstNumberNodeOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AstNumberNodeOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Value of this literal.
   */
  #[JsonProperty('value', required: true)]
  public float|int $value;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AstNumberNodeOutputType>,
   *   value: float|int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->value = $values['value'];

    $this->_dirtyFields = [
      'type' => true,
      'value' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
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
