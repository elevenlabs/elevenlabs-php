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
class AddKnowledgeBaseResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null
   * The folder path segments leading to this entity, from root to parent folder.
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   folderPath?: \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->folderPath = $values['folderPath'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true
    ];
    if (array_key_exists('folderPath', $values)) {
      $this->_dirtyFields['folder_path'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->folderPath ?? [] as $item) {
      $item->validate();
    }
  }
}
