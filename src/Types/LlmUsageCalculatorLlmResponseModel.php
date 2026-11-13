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
class LlmUsageCalculatorLlmResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\Llm>
   */
  #[JsonProperty('llm', required: true)]
  public string $llm;

  #[JsonProperty('price_per_minute', required: true)]
  public float $pricePerMinute;

  #[JsonProperty('price_per_message', required: true)]
  public float $pricePerMessage;

  /**
   * @param array{
   *   llm: value-of<\ElevenLabs\Types\Llm>,
   *   pricePerMinute: float,
   *   pricePerMessage: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llm = $values['llm'];
    $this->pricePerMinute = $values['pricePerMinute'];
    $this->pricePerMessage = $values['pricePerMessage'];

    $this->_dirtyFields = [
      'llm' => true,
      'price_per_minute' => true,
      'price_per_message' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'llm',
      'contents' => $this->llm
    ];

    $parts[] = [
      'name' => 'price_per_minute',
      'contents' => (string) $this->pricePerMinute
    ];

    $parts[] = [
      'name' => 'price_per_message',
      'contents' => (string) $this->pricePerMessage
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
