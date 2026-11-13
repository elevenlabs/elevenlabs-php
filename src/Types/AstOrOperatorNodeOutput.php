<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AstOrOperatorNodeOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AstOrOperatorNodeOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var \ElevenLabs\Types\AstNodeOutput[]
   * Child nodes of the logical operator.
   */
  #[JsonProperty('children', required: true), ArrayType([\ElevenLabs\Types\AstNodeOutput::class])]
  public array $children;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AstOrOperatorNodeOutputType>,
   *   children: \ElevenLabs\Types\AstNodeOutput[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->children = $values['children'];

    $this->_dirtyFields = [
      'type' => true,
      'children' => true
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
      'name' => 'children',
      'contents' => json_encode($this->children),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->children, 'children', minItems: 2);
  }
}
