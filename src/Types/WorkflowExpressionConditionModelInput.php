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
class WorkflowExpressionConditionModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Optional human-readable label for the condition used throughout the UI.
   */
  #[JsonProperty('label')]
  public ?string $label;

  /**
   * @var ?value-of<\ElevenLabs\Types\WorkflowExpressionConditionModelInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('expression', required: true)]
  public \ElevenLabs\Types\AstNodeInput $expression;

  /**
   * @param array{
   *   expression: \ElevenLabs\Types\AstNodeInput,
   *   label?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\WorkflowExpressionConditionModelInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'] ?? null;
    $this->type = $values['type'] ?? 'expression';
    $this->expression = $values['expression'];

    $this->_dirtyFields = [
      'expression' => true
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
      'name' => 'expression',
      'contents' => json_encode($this->expression),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
