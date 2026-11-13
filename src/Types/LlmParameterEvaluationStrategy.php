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
class LlmParameterEvaluationStrategy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\LlmParameterEvaluationStrategyType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * A description of the evaluation strategy to use for the test.
   */
  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\LlmParameterEvaluationStrategyType>,
   *   description: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->description = $values['description'];

    $this->_dirtyFields = [
      'type' => true,
      'description' => true
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
      'name' => 'description',
      'contents' => $this->description
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
