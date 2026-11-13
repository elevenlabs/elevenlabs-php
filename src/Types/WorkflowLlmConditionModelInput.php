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
class WorkflowLlmConditionModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Optional human-readable label for the condition used throughout the UI.
   */
  #[JsonProperty('label')]
  public ?string $label;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowLlmConditionModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Condition to evaluate
   */
  #[JsonProperty('condition', required: true)]
  public string $condition;

  /**
   * @param array{
   *   condition: string,
   *   label?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowLlmConditionModelInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'] ?? null;
    $this->type = $values['type'] ?? 'llm';
    $this->condition = $values['condition'];

    $this->_dirtyFields = [
      'condition' => true
    ];
    if (array_key_exists('label', $values)) {
      $this->_dirtyFields['label'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->label !== null) {
      $parts[] = [
        'name' => 'label',
        'contents' => $this->label
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'condition',
      'contents' => $this->condition
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
