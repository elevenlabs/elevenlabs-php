<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Date;
use DateTime;

/**
 * Tracks the link back to the original file in an external source.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ExternalFileSyncInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ExternalSyncProvider>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Entity ID in the external system
   */
  #[JsonProperty('source_entity_id', required: true)]
  public string $sourceEntityId;

  /**
   * Integration connection instance ID
   */
  #[JsonProperty('integration_connection_id', required: true)]
  public string $integrationConnectionId;

  /**
   * Folder ID in the external system this file was synced from
   */
  #[JsonProperty('source_parent_entity_id', required: true)]
  public string $sourceParentEntityId;

  /**
   * Original MIME type in the external system
   */
  #[JsonProperty('source_mime_type', required: true)]
  public string $sourceMimeType;

  /**
   * Last modified time from the external system
   */
  #[JsonProperty('source_modified_time', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $sourceModifiedTime;

  /**
   * KB folder ID of the sync root, used to query all entities under a sync tree
   */
  #[JsonProperty('root_folder_id')]
  public ?string $rootFolderId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ExternalSyncProvider>,
   *   sourceEntityId: string,
   *   integrationConnectionId: string,
   *   sourceParentEntityId: string,
   *   sourceMimeType: string,
   *   sourceModifiedTime: DateTime,
   *   rootFolderId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->sourceEntityId = $values['sourceEntityId'];
    $this->integrationConnectionId = $values['integrationConnectionId'];
    $this->sourceParentEntityId = $values['sourceParentEntityId'];
    $this->sourceMimeType = $values['sourceMimeType'];
    $this->sourceModifiedTime = $values['sourceModifiedTime'];
    $this->rootFolderId = $values['rootFolderId'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'source_entity_id' => true,
      'integration_connection_id' => true,
      'source_parent_entity_id' => true,
      'source_mime_type' => true,
      'source_modified_time' => true
    ];
    if (array_key_exists('rootFolderId', $values)) {
      $this->_dirtyFields['root_folder_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'source_entity_id',
      'contents' => $this->sourceEntityId
    ];

    $parts[] = [
      'name' => 'integration_connection_id',
      'contents' => $this->integrationConnectionId
    ];

    $parts[] = [
      'name' => 'source_parent_entity_id',
      'contents' => $this->sourceParentEntityId
    ];

    $parts[] = [
      'name' => 'source_mime_type',
      'contents' => $this->sourceMimeType
    ];

    $parts[] = [
      'name' => 'source_modified_time',
      'contents' => $this->sourceModifiedTime
    ];

    if ($this->rootFolderId !== null) {
      $parts[] = [
        'name' => 'root_folder_id',
        'contents' => $this->rootFolderId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
