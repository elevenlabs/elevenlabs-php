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
class AgentKnowledgeBaseRagListingEntryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the document or folder.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Name of the document or folder.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Whether the entry is a folder.
   */
  #[JsonProperty('is_folder', required: true)]
  public bool $isFolder;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   isFolder: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->isFolder = $values['isFolder'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'is_folder' => true
    ];
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

    $parts[] = [
      'name' => 'is_folder',
      'contents' => $this->isFolder ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
