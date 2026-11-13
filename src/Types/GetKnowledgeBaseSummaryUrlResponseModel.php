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
class GetKnowledgeBaseSummaryUrlResponseModel extends JsonSerializableType
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
   * @var \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null
   * The folder path segments leading to this entity, from root to parent folder.
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * @var \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModelDependentAgentsItem[]
   * This field is deprecated and will be removed in the future, use the separate endpoint to get dependent agents instead.
   */
  #[
    JsonProperty('dependent_agents', required: true),
    ArrayType([\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModelDependentAgentsItem::class])
  ]
  public array $dependentAgents;

  /**
   * @var value-of<\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('url', required: true)]
  public string $url;

  #[JsonProperty('auto_sync_info')]
  public ?\ElevenLabs\Types\AutoSyncInfo $autoSyncInfo;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   metadata: \ElevenLabs\Types\KnowledgeBaseDocumentMetadataResponseModel,
   *   supportedUsages: array<value-of<\ElevenLabs\Types\DocumentUsageModeEnum>>,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   dependentAgents: \ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModelDependentAgentsItem[],
   *   type: value-of<\ElevenLabs\Types\GetKnowledgeBaseSummaryUrlResponseModelType>,
   *   url: string,
   *   folderParentId?: ?string,
   *   folderPath?: \ElevenLabs\Types\KnowledgeBaseFolderPathSegmentSummaryResponseModel[]|null,
   *   autoSyncInfo?: ?\ElevenLabs\Types\AutoSyncInfo,
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
    $this->dependentAgents = $values['dependentAgents'];
    $this->type = $values['type'];
    $this->url = $values['url'];
    $this->autoSyncInfo = $values['autoSyncInfo'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'metadata' => true,
      'supported_usages' => true,
      'access_info' => true,
      'dependent_agents' => true,
      'type' => true,
      'url' => true
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
      'name' => 'dependent_agents',
      'contents' => json_encode($this->dependentAgents),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->autoSyncInfo !== null) {
      $parts[] = [
        'name' => 'auto_sync_info',
        'contents' => json_encode($this->autoSyncInfo),
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
  }
}
