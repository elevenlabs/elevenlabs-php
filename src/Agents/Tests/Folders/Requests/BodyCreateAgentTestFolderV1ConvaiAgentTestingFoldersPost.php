<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Folders\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateAgentTestFolderV1ConvaiAgentTestingFoldersPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the folder to create
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The ID of the parent folder. If not provided, the folder will be created at the root level.
   */
  #[JsonProperty('parent_folder_id')]
  public ?string $parentFolderId;

  /**
   * @param array{
   *   name: string,
   *   parentFolderId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->parentFolderId = $values['parentFolderId'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('parentFolderId', $values)) {
      $this->_dirtyFields['parent_folder_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->parentFolderId !== null) {
      $parts[] = [
        'name' => 'parent_folder_id',
        'contents' => $this->parentFolderId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
