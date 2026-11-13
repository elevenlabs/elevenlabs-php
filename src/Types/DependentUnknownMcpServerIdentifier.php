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
class DependentUnknownMcpServerIdentifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var ?value-of<\ElevenLabs\Types\DependentUnknownMcpServerIdentifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   id: string,
   *   type?: ?value-of<\ElevenLabs\Types\DependentUnknownMcpServerIdentifierType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->type = $values['type'] ?? 'unknown';

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
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
