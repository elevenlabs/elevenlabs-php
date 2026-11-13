<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A model that represents an agent dependent on a knowledge base/tools
 * to which the user has no direct access.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DependentUnknownAgentIdentifier extends JsonSerializableType
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

  /**
   * @var ?value-of<\ElevenLabs\Types\DependentUnknownAgentIdentifierType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   id: string,
   *   referencedResourceIds?: string[]|null,
   *   type?: ?value-of<\ElevenLabs\Types\DependentUnknownAgentIdentifierType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->referencedResourceIds = $values['referencedResourceIds'] ?? null;
    $this->id = $values['id'];
    $this->type = $values['type'] ?? 'unknown';

    $this->_dirtyFields = [
      'id' => true
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
