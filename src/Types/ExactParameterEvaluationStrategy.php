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
class ExactParameterEvaluationStrategy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ExactParameterEvaluationStrategyType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The exact string value that the parameter must match.
   */
  #[JsonProperty('expected_value', required: true)]
  public string $expectedValue;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ExactParameterEvaluationStrategyType>,
   *   expectedValue: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->expectedValue = $values['expectedValue'];

    $this->_dirtyFields = [
      'type' => true,
      'expected_value' => true
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
      'name' => 'expected_value',
      'contents' => $this->expectedValue
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
