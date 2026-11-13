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
class CreateCrawlJobResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @var value-of<\ElevenLabs\Types\CrawlType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('root_folder_id', required: true)]
  public string $rootFolderId;

  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null
   * The folder path segments leading to the root folder, from root to parent folder.
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * @param array{
   *   id: string,
   *   type: value-of<\ElevenLabs\Types\CrawlType>,
   *   rootFolderId: string,
   *   status: string,
   *   createdAt: int,
   *   folderPath?: \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->type = $values['type'];
    $this->rootFolderId = $values['rootFolderId'];
    $this->status = $values['status'];
    $this->createdAt = $values['createdAt'];
    $this->folderPath = $values['folderPath'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'type' => true,
      'root_folder_id' => true,
      'status' => true,
      'created_at' => true
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
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'root_folder_id',
      'contents' => $this->rootFolderId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
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
