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
class AstConditionalOperatorNodeOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AstConditionalOperatorNodeOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('condition', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $condition;

  #[JsonProperty('trueExpression', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $trueExpression;

  #[JsonProperty('falseExpression', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $falseExpression;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AstConditionalOperatorNodeOutputType>,
   *   condition: \ElevenLabs\Types\AstNodeOutput,
   *   trueExpression: \ElevenLabs\Types\AstNodeOutput,
   *   falseExpression: \ElevenLabs\Types\AstNodeOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->condition = $values['condition'];
    $this->trueExpression = $values['trueExpression'];
    $this->falseExpression = $values['falseExpression'];

    $this->_dirtyFields = [
      'type' => true,
      'condition' => true,
      'trueExpression' => true,
      'falseExpression' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'condition',
      'contents' => json_encode($this->condition),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'trueExpression',
      'contents' => json_encode($this->trueExpression),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'falseExpression',
      'contents' => json_encode($this->falseExpression),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
