<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MetronomeUsageColumnFilter extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\MetronomeUsageColumnFilterColumn>
   */
  #[JsonProperty('column', required: true)]
  public string $column;

  /**
   * @var value-of<\ElevenLabs\Types\MetronomeUsageColumnFilterOperation>
   */
  #[JsonProperty('operation', required: true)]
  public string $operation;

  /**
   * @var (string|int|float|DateTime|bool)[]
   */
  #[
    JsonProperty('values', required: true),
    ArrayType([new Union('string', 'integer', 'float', 'datetime', 'bool')])
  ]
  public array $values;

  /**
   * @param array{
   *   column: value-of<\ElevenLabs\Types\MetronomeUsageColumnFilterColumn>,
   *   operation: value-of<\ElevenLabs\Types\MetronomeUsageColumnFilterOperation>,
   *   values: (string|int|float|DateTime|bool)[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->column = $values['column'];
    $this->operation = $values['operation'];
    $this->values = $values['values'];

    $this->_dirtyFields = [
      'column' => true,
      'operation' => true,
      'values' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'column',
      'contents' => $this->column
    ];

    $parts[] = [
      'name' => 'operation',
      'contents' => $this->operation
    ];

    $parts[] = [
      'name' => 'values',
      'contents' => json_encode($this->values),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
