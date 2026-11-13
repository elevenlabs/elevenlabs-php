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
class AstDynamicVariableNodeInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AstDynamicVariableNodeInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The name of the dynamic variable.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @param array{
   *   name: string,
   *   type?: ?value-of<\ElevenLabs\Types\AstDynamicVariableNodeInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'dynamic_variable';
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'name' => true
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
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
