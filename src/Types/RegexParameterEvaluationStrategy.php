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
class RegexParameterEvaluationStrategy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\RegexParameterEvaluationStrategyType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * A regex pattern to match the agent's response against.
   */
  #[JsonProperty('pattern', required: true)]
  public string $pattern;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\RegexParameterEvaluationStrategyType>,
   *   pattern: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->pattern = $values['pattern'];

    $this->_dirtyFields = [
      'type' => true,
      'pattern' => true
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
      'name' => 'pattern',
      'contents' => $this->pattern
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
