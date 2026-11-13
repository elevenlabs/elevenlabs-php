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
class UnitTestSummaryResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the test
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * Name of the test
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The access information of the test
   */
  #[JsonProperty('access_info')]
  public ?\ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  /**
   * Creation time of the test in unix seconds
   */
  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  /**
   * Last update time of the test in unix seconds
   */
  #[JsonProperty('last_updated_at_unix_secs', required: true)]
  public int $lastUpdatedAtUnixSecs;

  /**
   * @var value-of<\ElevenLabs\Types\TestType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentTestEntityType>
   */
  #[JsonProperty('entity_type')]
  public ?string $entityType;

  /**
   * The ID of the parent folder
   */
  #[JsonProperty('folder_parent_id')]
  public ?string $folderParentId;

  /**
   * @var \ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel[]|null
   * The folder path segments from root to this entity
   */
  #[
    JsonProperty('folder_path'),
    ArrayType([\ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel::class])
  ]
  public ?array $folderPath;

  /**
   * Number of direct children (tests and subfolders) for folders only
   */
  #[JsonProperty('children_count')]
  public ?int $childrenCount;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConversationInitiationSource>
   * Channel the test simulates the conversation as. Null for folders or default behavior.
   */
  #[JsonProperty('conversation_initiation_source')]
  public ?string $conversationInitiationSource;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   createdAtUnixSecs: int,
   *   lastUpdatedAtUnixSecs: int,
   *   type: value-of<\ElevenLabs\Types\TestType>,
   *   accessInfo?: ?\ElevenLabs\Types\ResourceAccessInfo,
   *   entityType?: ?value-of<\ElevenLabs\Types\AgentTestEntityType>,
   *   folderParentId?: ?string,
   *   folderPath?: \ElevenLabs\Types\AgentTestFolderPathSegmentResponseModel[]|null,
   *   childrenCount?: ?int,
   *   conversationInitiationSource?: ?value-of<\ElevenLabs\Types\ConversationInitiationSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->accessInfo = $values['accessInfo'] ?? null;
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->lastUpdatedAtUnixSecs = $values['lastUpdatedAtUnixSecs'];
    $this->type = $values['type'];
    $this->entityType = $values['entityType'] ?? null;
    $this->folderParentId = $values['folderParentId'] ?? null;
    $this->folderPath = $values['folderPath'] ?? null;
    $this->childrenCount = $values['childrenCount'] ?? null;
    $this->conversationInitiationSource = $values['conversationInitiationSource'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'created_at_unix_secs' => true,
      'last_updated_at_unix_secs' => true,
      'type' => true
    ];
    if (array_key_exists('accessInfo', $values)) {
      $this->_dirtyFields['access_info'] = true;
    }
    if (array_key_exists('entityType', $values)) {
      $this->_dirtyFields['entity_type'] = true;
    }
    if (array_key_exists('folderParentId', $values)) {
      $this->_dirtyFields['folder_parent_id'] = true;
    }
    if (array_key_exists('folderPath', $values)) {
      $this->_dirtyFields['folder_path'] = true;
    }
    if (array_key_exists('childrenCount', $values)) {
      $this->_dirtyFields['children_count'] = true;
    }
    if (array_key_exists('conversationInitiationSource', $values)) {
      $this->_dirtyFields['conversation_initiation_source'] = true;
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

    if ($this->accessInfo !== null) {
      $parts[] = [
        'name' => 'access_info',
        'contents' => json_encode($this->accessInfo),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'last_updated_at_unix_secs',
      'contents' => (string) $this->lastUpdatedAtUnixSecs
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->entityType !== null) {
      $parts[] = [
        'name' => 'entity_type',
        'contents' => $this->entityType
      ];
    }

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

    if ($this->childrenCount !== null) {
      $parts[] = [
        'name' => 'children_count',
        'contents' => (string) $this->childrenCount
      ];
    }

    if ($this->conversationInitiationSource !== null) {
      $parts[] = [
        'name' => 'conversation_initiation_source',
        'contents' => $this->conversationInitiationSource
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->accessInfo?->validate();
    foreach ($this->folderPath ?? [] as $item) {
      $item->validate();
    }
  }
}
