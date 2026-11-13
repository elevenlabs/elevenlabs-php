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
class GetAgentTestFolderResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var \ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel[]|null
   * The path from the root folder to the current folder.
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * The number of direct children (tests and subfolders) in this folder
   */
  #[JsonProperty('children_count')]
  public ?int $childrenCount;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   folderPath?: \ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel[]|null,
   *   childrenCount?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->folderPath = $values['folderPath'] ?? null;
    $this->childrenCount = $values['childrenCount'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true
    ];
    if (array_key_exists('folderPath', $values)) {
      $this->_dirtyFields['folder_path'] = true;
    }
    if (array_key_exists('childrenCount', $values)) {
      $this->_dirtyFields['children_count'] = true;
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

    if ($this->folderPath !== null) {
      $parts[] = [
        'name' => 'folder_path',
        'contents' => json_encode($this->folderPath),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->childrenCount !== null) {
      $parts[] = [
        'name' => 'children_count',
        'contents' => (string) $this->childrenCount
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->folderPath ?? [] as $item) {
      $item->validate();
    }
  }
}
