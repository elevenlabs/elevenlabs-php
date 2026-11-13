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
class LlmUsageInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\LlmInputOutputTokensUsage>|null
   * Token usage and USD price per LLM, keyed by model ID and broken down by token category.
   */
  #[
    JsonProperty('model_usage'),
    ArrayType(['string' => \ElevenLabs\Types\LlmInputOutputTokensUsage::class])
  ]
  public ?array $modelUsage;

  /**
   * @param array{
   *   modelUsage?: array<string, \ElevenLabs\Types\LlmInputOutputTokensUsage>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->modelUsage = $values['modelUsage'] ?? null;

    if (array_key_exists('modelUsage', $values)) {
      $this->_dirtyFields['model_usage'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->modelUsage !== null) {
      $parts[] = [
        'name' => 'model_usage',
        'contents' => json_encode($this->modelUsage),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
