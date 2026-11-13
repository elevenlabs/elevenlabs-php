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
class KnowledgeBaseRagToolConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolConfigSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * @param array{
   *   systemToolType?: ?value-of<\ElevenLabs\Types\KnowledgeBaseRagToolConfigSystemToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->systemToolType = $values['systemToolType'] ?? 'knowledge_base_rag';

    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}
