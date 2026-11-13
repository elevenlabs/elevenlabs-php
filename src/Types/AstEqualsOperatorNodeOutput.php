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
class AstEqualsOperatorNodeOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AstEqualsOperatorNodeOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('left', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $left;

  #[JsonProperty('right', required: true)]
  public \ElevenLabs\Types\AstNodeOutput $right;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\AstEqualsOperatorNodeOutputType>,
   *   left: \ElevenLabs\Types\AstNodeOutput,
   *   right: \ElevenLabs\Types\AstNodeOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->left = $values['left'];
    $this->right = $values['right'];

    $this->_dirtyFields = [
      'type' => true,
      'left' => true,
      'right' => true
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
      'name' => 'left',
      'contents' => json_encode($this->left),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'right',
      'contents' => json_encode($this->right),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
