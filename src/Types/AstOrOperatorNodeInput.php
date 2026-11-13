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
class AstOrOperatorNodeInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstOrOperatorNodeInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var \ElevenLabs\Types\AstNodeInput[]
   * Child nodes of the logical operator.
   */
  #[JsonProperty('children', required: true), ArrayType([\ElevenLabs\Types\AstNodeInput::class])]
  public array $children;

  /**
   * @param array{
   *   children: \ElevenLabs\Types\AstNodeInput[],
   *   type?: ?value-of<\ElevenLabs\Types\AstOrOperatorNodeInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'or_operator';
    $this->children = $values['children'];

    $this->_dirtyFields = [
      'children' => true
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
