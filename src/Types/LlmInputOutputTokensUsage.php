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
class LlmInputOutputTokensUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('input')]
  public ?\ElevenLabs\Types\LlmTokensCategoryUsage $input;

  #[JsonProperty('input_cache_read')]
  public ?\ElevenLabs\Types\LlmTokensCategoryUsage $inputCacheRead;

  #[JsonProperty('input_cache_write')]
  public ?\ElevenLabs\Types\LlmTokensCategoryUsage $inputCacheWrite;

  #[JsonProperty('output_total')]
  public ?\ElevenLabs\Types\LlmTokensCategoryUsage $outputTotal;

  /**
   * @param array{
   *   input?: ?\ElevenLabs\Types\LlmTokensCategoryUsage,
   *   inputCacheRead?: ?\ElevenLabs\Types\LlmTokensCategoryUsage,
   *   inputCacheWrite?: ?\ElevenLabs\Types\LlmTokensCategoryUsage,
   *   outputTotal?: ?\ElevenLabs\Types\LlmTokensCategoryUsage,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->input = $values['input'] ?? null;
    $this->inputCacheRead = $values['inputCacheRead'] ?? null;
    $this->inputCacheWrite = $values['inputCacheWrite'] ?? null;
    $this->outputTotal = $values['outputTotal'] ?? null;

    if (array_key_exists('input', $values)) {
      $this->_dirtyFields['input'] = true;
    }
    if (array_key_exists('inputCacheRead', $values)) {
      $this->_dirtyFields['input_cache_read'] = true;
    }
    if (array_key_exists('inputCacheWrite', $values)) {
      $this->_dirtyFields['input_cache_write'] = true;
    }
    if (array_key_exists('outputTotal', $values)) {
      $this->_dirtyFields['output_total'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->input !== null) {
      $parts[] = [
        'name' => 'input',
        'contents' => json_encode($this->input),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->inputCacheRead !== null) {
      $parts[] = [
        'name' => 'input_cache_read',
        'contents' => json_encode($this->inputCacheRead),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->inputCacheWrite !== null) {
      $parts[] = [
        'name' => 'input_cache_write',
        'contents' => json_encode($this->inputCacheWrite),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outputTotal !== null) {
      $parts[] = [
        'name' => 'output_total',
        'contents' => json_encode($this->outputTotal),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->input?->validate();
    $this->inputCacheRead?->validate();
    $this->inputCacheWrite?->validate();
    $this->outputTotal?->validate();
  }
}
