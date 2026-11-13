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
class LlmUsageCalculatorResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\LlmUsageCalculatorLlmResponseModel[]
   */
  #[
    JsonProperty('llm_prices', required: true),
    ArrayType([\ElevenLabs\Types\LlmUsageCalculatorLlmResponseModel::class])
  ]
  public array $llmPrices;

  /**
   * @param array{
   *   llmPrices: \ElevenLabs\Types\LlmUsageCalculatorLlmResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llmPrices = $values['llmPrices'];

    $this->_dirtyFields = [
      'llm_prices' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'llm_prices',
      'contents' => json_encode($this->llmPrices),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->llmPrices as $item) {
      $item->validate();
    }
  }
}
