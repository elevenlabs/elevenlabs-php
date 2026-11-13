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
class GetKnowledgeBaseFolderResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('metadata', required: true)]
  public \ElevenLabs\Types\KnowledgeBaseDocumentMetadataResponseModel $metadata;

  /**
   * @var array<value-of<\ElevenLabs\Types\DocumentUsageModeEnum>>
   */
  #[JsonProperty('supported_usages', required: true), ArrayType(['string'])]
  public array $supportedUsages;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * The ID of the parent folder, or null if the document is at the root level.
   */
  #[JsonProperty('folder_parent_id')]
  public ?string $folderParentId;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentResponseModel[]|null
   * The folder path segments leading to this entity, from root to parent folder.
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseFolderPathSegmentResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * @var value-of<\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('children_count', required: true)]
  public int $childrenCount;

  /**
   * Number of non-folder documents anywhere in this folder's subtree (recursive). Counting stops past 1000;
   */
  #[JsonProperty('document_count', required: true)]
  public int $documentCount;

  #[JsonProperty('auto_sync_info')]
  public ?\ElevenLabs\Types\AutoSyncInfo $autoSyncInfo;

  #[JsonProperty('external_sync_info')]
  public ?\ElevenLabs\Types\ExternalFolderSyncInfo $externalSyncInfo;

  #[JsonProperty('is_frozen')]
  public ?bool $isFrozen;

  /**
   * Most recent (in-flight or terminal) external sync job for this folder, if any. Used by clients to render sync progress.
   */
  #[JsonProperty('active_sync_job')]
  public ?\ElevenLabs\Types\KbExternalSyncJob $activeSyncJob;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   metadata: \ElevenLabs\Types\KnowledgeBaseDocumentMetadataResponseModel,
   *   supportedUsages: array<value-of<\ElevenLabs\Types\DocumentUsageModeEnum>>,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   type: value-of<\ElevenLabs\Types\GetKnowledgeBaseFolderResponseModelType>,
   *   childrenCount: int,
   *   documentCount: int,
   *   folderParentId?: ?string,
   *   folderPath?: \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentResponseModel[]|null,
   *   autoSyncInfo?: ?\ElevenLabs\Types\AutoSyncInfo,
   *   externalSyncInfo?: ?\ElevenLabs\Types\ExternalFolderSyncInfo,
   *   isFrozen?: ?bool,
   *   activeSyncJob?: ?\ElevenLabs\Types\KbExternalSyncJob,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->metadata = $values['metadata'];
    $this->supportedUsages = $values['supportedUsages'];
    $this->accessInfo = $values['accessInfo'];
    $this->folderParentId = $values['folderParentId'] ?? null;
    $this->folderPath = $values['folderPath'] ?? null;
    $this->type = $values['type'];
    $this->childrenCount = $values['childrenCount'];
    $this->documentCount = $values['documentCount'];
    $this->autoSyncInfo = $values['autoSyncInfo'] ?? null;
    $this->externalSyncInfo = $values['externalSyncInfo'] ?? null;
    $this->isFrozen = $values['isFrozen'] ?? null;
    $this->activeSyncJob = $values['activeSyncJob'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'metadata' => true,
      'supported_usages' => true,
      'access_info' => true,
      'type' => true,
      'children_count' => true,
      'document_count' => true
    ];
    if (array_key_exists('folderParentId', $values)) {
      $this->_dirtyFields['folder_parent_id'] = true;
    }
    if (array_key_exists('folderPath', $values)) {
      $this->_dirtyFields['folder_path'] = true;
    }
    if (array_key_exists('autoSyncInfo', $values)) {
      $this->_dirtyFields['auto_sync_info'] = true;
    }
    if (array_key_exists('externalSyncInfo', $values)) {
      $this->_dirtyFields['external_sync_info'] = true;
    }
    if (array_key_exists('isFrozen', $values)) {
      $this->_dirtyFields['is_frozen'] = true;
    }
    if (array_key_exists('activeSyncJob', $values)) {
      $this->_dirtyFields['active_sync_job'] = true;
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

    $parts[] = [
      'name' => 'metadata',
      'contents' => json_encode($this->metadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    foreach ($this->supportedUsages as $item) {
      $parts[] = [
        'name' => 'supported_usages',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->folderParentId !== null) {
      $parts[] = [
        'name' => 'folder_parent_id',
        'contents' => $this->folderParentId
      ];
    }

    if ($this->folderPath !== null) {
      $parts[] = [
        'name' => 'folder_path',
        'contents' => json_encode($this->folderPath),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'children_count',
      'contents' => (string) $this->childrenCount
    ];

    $parts[] = [
      'name' => 'document_count',
      'contents' => (string) $this->documentCount
    ];

    if ($this->autoSyncInfo !== null) {
      $parts[] = [
        'name' => 'auto_sync_info',
        'contents' => json_encode($this->autoSyncInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->externalSyncInfo !== null) {
      $parts[] = [
        'name' => 'external_sync_info',
        'contents' => json_encode($this->externalSyncInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isFrozen !== null) {
      $parts[] = [
        'name' => 'is_frozen',
        'contents' => $this->isFrozen ? 'true' : 'false'
      ];
    }

    if ($this->activeSyncJob !== null) {
      $parts[] = [
        'name' => 'active_sync_job',
        'contents' => json_encode($this->activeSyncJob),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->metadata->validate();
    $this->accessInfo->validate();
    foreach ($this->folderPath ?? [] as $item) {
      $item->validate();
    }
    $this->autoSyncInfo?->validate();
    $this->externalSyncInfo?->validate();
    $this->activeSyncJob?->validate();
  }
}
