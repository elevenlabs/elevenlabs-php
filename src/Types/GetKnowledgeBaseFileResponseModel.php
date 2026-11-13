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
class GetKnowledgeBaseFileResponseModel extends JsonSerializableType
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
   * @var value-of<\ElevenLabs\Types\GetKnowledgeBaseFileResponseModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('extracted_inner_html', required: true)]
  public string $extractedInnerHtml;

  /**
   * @var ?value-of<\ElevenLabs\Types\ContentFormat>
   * Canonical representation of a knowledge base document's stored content.
   *
   * HTML is the legacy default; documents created before this field existed are
   * interpreted as HTML.
   */
  #[JsonProperty('content_format')]
  public ?string $contentFormat;

  #[JsonProperty('filename', required: true)]
  public string $filename;

  #[JsonProperty('external_sync_info')]
  public ?\ElevenLabs\Types\ExternalFileSyncInfo $externalSyncInfo;

  #[JsonProperty('auto_sync_info')]
  public ?\ElevenLabs\Types\AutoSyncInfo $autoSyncInfo;

  /**
   * In-flight or last refresh state for an externally-synced file. Used by clients to render sync progress and disable re-sync while a refresh is queued or processing.
   */
  #[JsonProperty('refresh_status')]
  public ?\ElevenLabs\Types\FileRefreshStatus $refreshStatus;

  #[JsonProperty('is_frozen')]
  public ?bool $isFrozen;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   metadata: \ElevenLabs\Types\KnowledgeBaseDocumentMetadataResponseModel,
   *   supportedUsages: array<value-of<\ElevenLabs\Types\DocumentUsageModeEnum>>,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   type: value-of<\ElevenLabs\Types\GetKnowledgeBaseFileResponseModelType>,
   *   extractedInnerHtml: string,
   *   filename: string,
   *   folderParentId?: ?string,
   *   folderPath?: \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentResponseModel[]|null,
   *   contentFormat?: ?value-of<\ElevenLabs\Types\ContentFormat>,
   *   externalSyncInfo?: ?\ElevenLabs\Types\ExternalFileSyncInfo,
   *   autoSyncInfo?: ?\ElevenLabs\Types\AutoSyncInfo,
   *   refreshStatus?: ?\ElevenLabs\Types\FileRefreshStatus,
   *   isFrozen?: ?bool,
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
    $this->extractedInnerHtml = $values['extractedInnerHtml'];
    $this->contentFormat = $values['contentFormat'] ?? null;
    $this->filename = $values['filename'];
    $this->externalSyncInfo = $values['externalSyncInfo'] ?? null;
    $this->autoSyncInfo = $values['autoSyncInfo'] ?? null;
    $this->refreshStatus = $values['refreshStatus'] ?? null;
    $this->isFrozen = $values['isFrozen'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'metadata' => true,
      'supported_usages' => true,
      'access_info' => true,
      'type' => true,
      'extracted_inner_html' => true,
      'filename' => true
    ];
    if (array_key_exists('folderParentId', $values)) {
      $this->_dirtyFields['folder_parent_id'] = true;
    }
    if (array_key_exists('folderPath', $values)) {
      $this->_dirtyFields['folder_path'] = true;
    }
    if (array_key_exists('contentFormat', $values)) {
      $this->_dirtyFields['content_format'] = true;
    }
    if (array_key_exists('externalSyncInfo', $values)) {
      $this->_dirtyFields['external_sync_info'] = true;
    }
    if (array_key_exists('autoSyncInfo', $values)) {
      $this->_dirtyFields['auto_sync_info'] = true;
    }
    if (array_key_exists('refreshStatus', $values)) {
      $this->_dirtyFields['refresh_status'] = true;
    }
    if (array_key_exists('isFrozen', $values)) {
      $this->_dirtyFields['is_frozen'] = true;
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
      'name' => 'extracted_inner_html',
      'contents' => $this->extractedInnerHtml
    ];

    if ($this->contentFormat !== null) {
      $parts[] = [
        'name' => 'content_format',
        'contents' => $this->contentFormat
      ];
    }

    $parts[] = [
      'name' => 'filename',
      'contents' => $this->filename
    ];

    if ($this->externalSyncInfo !== null) {
      $parts[] = [
        'name' => 'external_sync_info',
        'contents' => json_encode($this->externalSyncInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->autoSyncInfo !== null) {
      $parts[] = [
        'name' => 'auto_sync_info',
        'contents' => json_encode($this->autoSyncInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->refreshStatus !== null) {
      $parts[] = [
        'name' => 'refresh_status',
        'contents' => json_encode($this->refreshStatus),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isFrozen !== null) {
      $parts[] = [
        'name' => 'is_frozen',
        'contents' => $this->isFrozen ? 'true' : 'false'
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
    $this->externalSyncInfo?->validate();
    $this->autoSyncInfo?->validate();
    $this->refreshStatus?->validate();
  }
}
