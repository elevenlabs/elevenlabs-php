<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ToolResponseMockConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\UnitTestToolCallParameter[]|null
   * If the list is empty, the mock will always activate.
   */
  #[
    JsonProperty('parameter_conditions'),
    ArrayType([\ElevenLabs\Types\UnitTestToolCallParameter::class])
  ]
  public ?array $parameterConditions;

  /**
   * The return value the LLM sees when this mock is active.
   */
  #[JsonProperty('mock_result', required: true)]
  public string $mockResult;

  /**
   * If true, the mock result is surfaced to the LLM as a tool error rather than a successful result.
   */
  #[JsonProperty('is_error')]
  public ?bool $isError;

  /**
   * @param array{
   *   mockResult: string,
   *   parameterConditions?: \ElevenLabs\Types\UnitTestToolCallParameter[]|null,
   *   isError?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->parameterConditions = $values['parameterConditions'] ?? null;
    $this->mockResult = $values['mockResult'];
    $this->isError = $values['isError'] ?? null;

    $this->_dirtyFields = [
      'mock_result' => true
    ];
    if (array_key_exists('parameterConditions', $values)) {
      $this->_dirtyFields['parameter_conditions'] = true;
    }
    if (array_key_exists('isError', $values)) {
      $this->_dirtyFields['is_error'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->parameterConditions !== null) {
      $parts[] = [
        'name' => 'parameter_conditions',
        'contents' => json_encode($this->parameterConditions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'mock_result',
      'contents' => $this->mockResult
    ];

    if ($this->isError !== null) {
      $parts[] = [
        'name' => 'is_error',
        'contents' => $this->isError ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->parameterConditions ?? [] as $item) {
      $item->validate();
    }
  }
}
