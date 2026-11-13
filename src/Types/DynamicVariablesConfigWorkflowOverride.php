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
class DynamicVariablesConfigWorkflowOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, mixed>|null
   * A dictionary of dynamic variable placeholders and their values
   */
  #[JsonProperty('dynamic_variable_placeholders'), ArrayType(['string' => 'mixed'])]
  public ?array $dynamicVariablePlaceholders;

  /**
   * @param array{
   *   dynamicVariablePlaceholders?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->dynamicVariablePlaceholders = $values['dynamicVariablePlaceholders'] ?? null;

    if (array_key_exists('dynamicVariablePlaceholders', $values)) {
      $this->_dirtyFields['dynamic_variable_placeholders'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->dynamicVariablePlaceholders !== null) {
      $parts[] = [
        'name' => 'dynamic_variable_placeholders',
        'contents' => json_encode($this->dynamicVariablePlaceholders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
