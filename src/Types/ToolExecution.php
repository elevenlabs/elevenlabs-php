<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Execution-related properties for a tool (2025-11-25 only).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ToolExecution extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolExecutionTaskSupport>
   */
  #[JsonProperty('taskSupport')]
  public ?string $taskSupport;

  /**
   * @param array{
   *   taskSupport?: ?value-of<\ElevenLabs\Types\ToolExecutionTaskSupport>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->taskSupport = $values['taskSupport'] ?? null;

    if (array_key_exists('taskSupport', $values)) {
      $this->_dirtyFields['taskSupport'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->taskSupport !== null) {
      $parts[] = [
        'name' => 'taskSupport',
        'contents' => $this->taskSupport
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
