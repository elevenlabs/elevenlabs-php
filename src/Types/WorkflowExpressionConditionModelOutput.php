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
class WorkflowExpressionConditionModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Optional human-readable label for the condition used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public ?string $label;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowExpressionConditionModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('expression', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $expression;

  /**
   * @param array{
   *   label: ?string,
   *   type: value-of<\ElevenLabs\Types\WorkflowExpressionConditionModelOutputType>,
   *   expression: \ElevenLabs\Types\AstNodeOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'];
    $this->type = $values['type'];
    $this->expression = $values['expression'];

    $this->_dirtyFields = [
      'label' => true,
      'type' => true,
      'expression' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

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
