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
class AgentMetadataDbModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('updated_at_unix_secs', required: true)]
  public int $updatedAtUnixSecs;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDefinitionSource>
   */
  #[JsonProperty('created_from')]
  public ?string $createdFrom;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDefinitionSource>
   */
  #[JsonProperty('last_updated_from')]
  public ?string $lastUpdatedFrom;

  /**
   * @param array{
   *   createdAtUnixSecs: int,
   *   updatedAtUnixSecs: int,
   *   createdFrom?: ?value-of<\ElevenLabs\Types\AgentDefinitionSource>,
   *   lastUpdatedFrom?: ?value-of<\ElevenLabs\Types\AgentDefinitionSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->updatedAtUnixSecs = $values['updatedAtUnixSecs'];
    $this->createdFrom = $values['createdFrom'] ?? null;
    $this->lastUpdatedFrom = $values['lastUpdatedFrom'] ?? null;

    $this->_dirtyFields = [
      'created_at_unix_secs' => true,
      'updated_at_unix_secs' => true
    ];
    if (array_key_exists('createdFrom', $values)) {
      $this->_dirtyFields['created_from'] = true;
    }
    if (array_key_exists('lastUpdatedFrom', $values)) {
      $this->_dirtyFields['last_updated_from'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'updated_at_unix_secs',
      'contents' => (string) $this->updatedAtUnixSecs
    ];

    if ($this->createdFrom !== null) {
      $parts[] = [
        'name' => 'created_from',
        'contents' => $this->createdFrom
      ];
    }

    if ($this->lastUpdatedFrom !== null) {
      $parts[] = [
        'name' => 'last_updated_from',
        'contents' => $this->lastUpdatedFrom
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
