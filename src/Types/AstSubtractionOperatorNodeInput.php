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
class AstSubtractionOperatorNodeInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstSubtractionOperatorNodeInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('left', required: true)]
  public \ElevenLabs\Types\AstNodeInput $left;

  #[JsonProperty('right', required: true)]
  public \ElevenLabs\Types\AstNodeInput $right;

  /**
   * @param array{
   *   left: \ElevenLabs\Types\AstNodeInput,
   *   right: \ElevenLabs\Types\AstNodeInput,
   *   type?: ?value-of<\ElevenLabs\Types\AstSubtractionOperatorNodeInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'sub_operator';
    $this->left = $values['left'];
    $this->right = $values['right'];

    $this->_dirtyFields = [
      'left' => true,
      'right' => true
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
