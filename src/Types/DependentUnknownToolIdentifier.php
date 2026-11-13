<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A model that represents an tool dependent on a knowledge base/tools
 * to which the user has no direct access.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DependentUnknownToolIdentifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DependentUnknownToolIdentifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @param array{
   *   id: string,
   *   type?: ?value-of<\ElevenLabs\Types\DependentUnknownToolIdentifierType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'unknown';
    $this->id = $values['id'];

    $this->_dirtyFields = [
      'id' => true
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
      'name' => 'id',
      'contents' => $this->id
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
