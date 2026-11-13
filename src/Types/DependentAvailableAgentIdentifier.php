<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DependentAvailableAgentIdentifier extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]|null
   * If the agent is a transitive dependent, contains IDs of the resources that the agent depends on directly.
   */
  #[JsonProperty('referenced_resource_ids'), ArrayType(['string'])]
  public ?array $referencedResourceIds;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\DependentAvailableAgentIdentifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * @var value-of<\ElevenLabs\Types\DependentAvailableAgentIdentifierAccessLevel>
   */
  #[JsonProperty('access_level', required: true)]
  public string $accessLevel;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   createdAtUnixSecs: int,
   *   accessLevel: value-of<\ElevenLabs\Types\DependentAvailableAgentIdentifierAccessLevel>,
   *   referencedResourceIds?: string[]|null,
   *   type?: ?value-of<\ElevenLabs\Types\DependentAvailableAgentIdentifierType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->referencedResourceIds = $values['referencedResourceIds'] ?? null;
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
    if (array_key_exists('referencedResourceIds', $values)) {
      $this->_dirtyFields['referenced_resource_ids'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->referencedResourceIds !== null) {
      foreach ($this->referencedResourceIds ?? [] as $item) {
        $parts[] = [
          'name' => 'referenced_resource_ids',
          'contents' => $item
        ];
      }
    }

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
