<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Config container for custom guardrails list
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CustomGuardrailsConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\CustomGuardrailConfig[]|null
   */
  #[JsonProperty('configs'), ArrayType([\ElevenLabs\Types\CustomGuardrailConfig::class])]
  public ?array $configs;

  /**
   * @param array{
   *   configs?: \ElevenLabs\Types\CustomGuardrailConfig[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->configs = $values['configs'] ?? null;

    if (array_key_exists('configs', $values)) {
      $this->_dirtyFields['configs'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->configs !== null) {
      $parts[] = [
        'name' => 'configs',
        'contents' => json_encode($this->configs),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->configs ?? [] as $item) {
      $item->validate();
    }
  }
}
