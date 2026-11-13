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
class KnowledgeBaseToolInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<value-of<\ElevenLabs\Types\SearchStrategy>>|null
   * Search strategies exposed to the model. Must be non-empty.
   */
  #[JsonProperty('enabled_strategies'), ArrayType(['string'])]
  public ?array $enabledStrategies;

  /**
   * @param array{
   *   enabledStrategies?: array<value-of<\ElevenLabs\Types\SearchStrategy>>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabledStrategies = $values['enabledStrategies'] ?? null;

    if (array_key_exists('enabledStrategies', $values)) {
      $this->_dirtyFields['enabled_strategies'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabledStrategies !== null) {
      foreach ($this->enabledStrategies ?? [] as $item) {
        $parts[] = [
          'name' => 'enabled_strategies',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
