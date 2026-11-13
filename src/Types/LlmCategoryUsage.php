<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * LLM usage of a conversation, split by whether the generated response reached the user.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LlmCategoryUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('irreversible_generation')]
  public ?\ElevenLabs\Types\LlmUsageOutput $irreversibleGeneration;

  #[JsonProperty('initiated_generation')]
  public ?\ElevenLabs\Types\LlmUsageOutput $initiatedGeneration;

  /**
   * @param array{
   *   irreversibleGeneration?: ?\ElevenLabs\Types\LlmUsageOutput,
   *   initiatedGeneration?: ?\ElevenLabs\Types\LlmUsageOutput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->irreversibleGeneration = $values['irreversibleGeneration'] ?? null;
    $this->initiatedGeneration = $values['initiatedGeneration'] ?? null;

    if (array_key_exists('irreversibleGeneration', $values)) {
      $this->_dirtyFields['irreversible_generation'] = true;
    }
    if (array_key_exists('initiatedGeneration', $values)) {
      $this->_dirtyFields['initiated_generation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->irreversibleGeneration !== null) {
      $parts[] = [
        'name' => 'irreversible_generation',
        'contents' => json_encode($this->irreversibleGeneration),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->initiatedGeneration !== null) {
      $parts[] = [
        'name' => 'initiated_generation',
        'contents' => json_encode($this->initiatedGeneration),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->irreversibleGeneration?->validate();
    $this->initiatedGeneration?->validate();
  }
}
