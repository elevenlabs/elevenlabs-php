<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Container for custom guardrails, matching ModerationGuardrail pattern
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomGuardrailInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Config container for custom guardrails list
   */
  #[JsonProperty('config')]
  public ?\ElevenLabs\Types\CustomGuardrailsConfigInput $config;

  /**
   * @param array{
   *   config?: ?\ElevenLabs\Types\CustomGuardrailsConfigInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->config = $values['config'] ?? null;

    if (array_key_exists('config', $values)) {
      $this->_dirtyFields['config'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->config !== null) {
      $parts[] = [
        'name' => 'config',
        'contents' => json_encode($this->config),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->config?->validate();
  }
}
