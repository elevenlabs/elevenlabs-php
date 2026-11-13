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
class AstConditionalOperatorNodeInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstConditionalOperatorNodeInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('condition', required: true)]
  public \ElevenLabs\Types\AstNodeInput $condition;

  #[JsonProperty('trueExpression', required: true)]
  public \ElevenLabs\Types\AstNodeInput $trueExpression;

  #[JsonProperty('falseExpression', required: true)]
  public \ElevenLabs\Types\AstNodeInput $falseExpression;

  /**
   * @param array{
   *   condition: \ElevenLabs\Types\AstNodeInput,
   *   trueExpression: \ElevenLabs\Types\AstNodeInput,
   *   falseExpression: \ElevenLabs\Types\AstNodeInput,
   *   type?: ?value-of<\ElevenLabs\Types\AstConditionalOperatorNodeInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'conditional_operator';
    $this->condition = $values['condition'];
    $this->trueExpression = $values['trueExpression'];
    $this->falseExpression = $values['falseExpression'];

    $this->_dirtyFields = [
      'condition' => true,
      'trueExpression' => true,
      'falseExpression' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

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
