<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class KbExternalSyncJob extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ExternalSyncProvider>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('folder_id', required: true)]
  public string $folderId;

  #[JsonProperty('integration_connection_id', required: true)]
  public string $integrationConnectionId;

  /**
   * @var value-of<\ElevenLabs\Types\ExternalSyncJobTrigger>
   */
  #[JsonProperty('triggered_by', required: true)]
  public string $triggeredBy;

  /**
   * @var ?value-of<\ElevenLabs\Types\CrawlStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * @var ?value-of<\ElevenLabs\Types\ExternalSyncJobType>
   */
  #[JsonProperty('sync_type')]
  public ?string $syncType;

  #[JsonProperty('items_identified')]
  public ?int $itemsIdentified;

  #[JsonProperty('items_processed')]
  public ?int $itemsProcessed;

  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  #[JsonProperty('started_at')]
  public ?int $startedAt;

  #[JsonProperty('completed_at')]
  public ?int $completedAt;

  #[JsonProperty('updated_at', required: true)]
  public int $updatedAt;

  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('created_at', required: true)]
  public int $createdAt;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ExternalSyncProvider>,
   *   folderId: string,
   *   integrationConnectionId: string,
   *   triggeredBy: value-of<\ElevenLabs\Types\ExternalSyncJobTrigger>,
   *   updatedAt: int,
   *   id: string,
   *   createdAt: int,
   *   status?: ?value-of<\ElevenLabs\Types\CrawlStatus>,
   *   syncType?: ?value-of<\ElevenLabs\Types\ExternalSyncJobType>,
   *   itemsIdentified?: ?int,
   *   itemsProcessed?: ?int,
   *   errorMessage?: ?string,
   *   startedAt?: ?int,
   *   completedAt?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->folderId = $values['folderId'];
    $this->integrationConnectionId = $values['integrationConnectionId'];
    $this->triggeredBy = $values['triggeredBy'];
    $this->status = $values['status'] ?? null;
    $this->syncType = $values['syncType'] ?? null;
    $this->itemsIdentified = $values['itemsIdentified'] ?? null;
    $this->itemsProcessed = $values['itemsProcessed'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;
    $this->startedAt = $values['startedAt'] ?? null;
    $this->completedAt = $values['completedAt'] ?? null;
    $this->updatedAt = $values['updatedAt'];
    $this->id = $values['id'];
    $this->createdAt = $values['createdAt'];

    $this->_dirtyFields = [
      'type' => true,
      'folder_id' => true,
      'integration_connection_id' => true,
      'triggered_by' => true,
      'updated_at' => true,
      'id' => true,
      'created_at' => true
    ];
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('syncType', $values)) {
      $this->_dirtyFields['sync_type'] = true;
    }
    if (array_key_exists('itemsIdentified', $values)) {
      $this->_dirtyFields['items_identified'] = true;
    }
    if (array_key_exists('itemsProcessed', $values)) {
      $this->_dirtyFields['items_processed'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
    if (array_key_exists('startedAt', $values)) {
      $this->_dirtyFields['started_at'] = true;
    }
    if (array_key_exists('completedAt', $values)) {
      $this->_dirtyFields['completed_at'] = true;
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
      'name' => 'folder_id',
      'contents' => $this->folderId
    ];

    $parts[] = [
      'name' => 'integration_connection_id',
      'contents' => $this->integrationConnectionId
    ];

    $parts[] = [
      'name' => 'triggered_by',
      'contents' => $this->triggeredBy
    ];

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->syncType !== null) {
      $parts[] = [
        'name' => 'sync_type',
        'contents' => $this->syncType
      ];
    }

    if ($this->itemsIdentified !== null) {
      $parts[] = [
        'name' => 'items_identified',
        'contents' => (string) $this->itemsIdentified
      ];
    }

    if ($this->itemsProcessed !== null) {
      $parts[] = [
        'name' => 'items_processed',
        'contents' => (string) $this->itemsProcessed
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    if ($this->startedAt !== null) {
      $parts[] = [
        'name' => 'started_at',
        'contents' => (string) $this->startedAt
      ];
    }

    if ($this->completedAt !== null) {
      $parts[] = [
        'name' => 'completed_at',
        'contents' => (string) $this->completedAt
      ];
    }

    $parts[] = [
      'name' => 'updated_at',
      'contents' => (string) $this->updatedAt
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'created_at',
      'contents' => (string) $this->createdAt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
