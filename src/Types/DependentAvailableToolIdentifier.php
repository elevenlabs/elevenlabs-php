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
class DependentAvailableToolIdentifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\DependentAvailableToolIdentifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * @var value-of<\ElevenLabs\Types\DependentAvailableToolIdentifierAccessLevel>
   */
  #[JsonProperty('access_level', required: true)]
  public string $accessLevel;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   createdAtUnixSecs: int,
   *   accessLevel: value-of<\ElevenLabs\Types\DependentAvailableToolIdentifierAccessLevel>,
   *   type?: ?value-of<\ElevenLabs\Types\DependentAvailableToolIdentifierType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->type = $values['type'] ?? 'available';
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->accessLevel = $values['accessLevel'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'created_at_unix_secs' => true,
      'access_level' => true
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

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'access_level',
      'contents' => $this->accessLevel
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
