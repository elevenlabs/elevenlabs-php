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
class KnowledgeBaseToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * @var array<value-of<\ElevenLabs\Types\SearchStrategy>>|null
   */
  #[JsonProperty('enabled_strategies'), ArrayType(['string'])]
  public ?array $enabledStrategies;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\KnowledgeBaseToolConfigSystemToolType>,
   *   enabledStrategies?: array<value-of<\ElevenLabs\Types\SearchStrategy>>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'knowledge_base';
    $this->enabledStrategies = $values['enabledStrategies'] ?? null;

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('enabledStrategies', $values)) {
      $this->_dirtyFields['enabled_strategies'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->systemToolType !== null) {
      $parts[] = [
        'name' => 'system_tool_type',
        'contents' => $this->systemToolType
      ];
    }

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
