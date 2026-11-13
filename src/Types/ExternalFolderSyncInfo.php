<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Metadata for a KB folder that mirrors an external source folder.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ExternalFolderSyncInfo extends JsonSerializableType
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
   * KB folder ID of the sync root. None means this folder is the root.
   */
  #[JsonProperty('root_folder_id')]
  public ?string $rootFolderId;

  /**
   * Opaque cursor for incremental sync, interpreted by the provider
   */
  #[JsonProperty('sync_cursor')]
  public ?string $syncCursor;

  /**
   * Unix timestamp of last completed sync
   */
  #[JsonProperty('last_sync_at')]
  public ?int $lastSyncAt;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ExternalSyncProvider>,
   *   sourceEntityId: string,
   *   integrationConnectionId: string,
   *   rootFolderId?: ?string,
   *   syncCursor?: ?string,
   *   lastSyncAt?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->sourceEntityId = $values['sourceEntityId'];
    $this->integrationConnectionId = $values['integrationConnectionId'];
    $this->rootFolderId = $values['rootFolderId'] ?? null;
    $this->syncCursor = $values['syncCursor'] ?? null;
    $this->lastSyncAt = $values['lastSyncAt'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'source_entity_id' => true,
      'integration_connection_id' => true
    ];
    if (array_key_exists('rootFolderId', $values)) {
      $this->_dirtyFields['root_folder_id'] = true;
    }
    if (array_key_exists('syncCursor', $values)) {
      $this->_dirtyFields['sync_cursor'] = true;
    }
    if (array_key_exists('lastSyncAt', $values)) {
      $this->_dirtyFields['last_sync_at'] = true;
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

    if ($this->rootFolderId !== null) {
      $parts[] = [
        'name' => 'root_folder_id',
        'contents' => $this->rootFolderId
      ];
    }

    if ($this->syncCursor !== null) {
      $parts[] = [
        'name' => 'sync_cursor',
        'contents' => $this->syncCursor
      ];
    }

    if ($this->lastSyncAt !== null) {
      $parts[] = [
        'name' => 'last_sync_at',
        'contents' => (string) $this->lastSyncAt
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
