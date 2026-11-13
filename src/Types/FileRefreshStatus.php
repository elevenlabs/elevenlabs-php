<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * In-flight/last refresh state for an externally-synced KB file.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class FileRefreshStatus extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CrawlStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('enqueued_at')]
  public ?int $enqueuedAt;

  #[JsonProperty('started_at')]
  public ?int $startedAt;

  #[JsonProperty('completed_at')]
  public ?int $completedAt;

  #[JsonProperty('last_synced_at')]
  public ?int $lastSyncedAt;

  #[JsonProperty('error_message')]
  public ?string $errorMessage;

  /**
   * @param array{
   *   status?: ?value-of<\ElevenLabs\Types\CrawlStatus>,
   *   enqueuedAt?: ?int,
   *   startedAt?: ?int,
   *   completedAt?: ?int,
   *   lastSyncedAt?: ?int,
   *   errorMessage?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->status = $values['status'] ?? null;
    $this->enqueuedAt = $values['enqueuedAt'] ?? null;
    $this->startedAt = $values['startedAt'] ?? null;
    $this->completedAt = $values['completedAt'] ?? null;
    $this->lastSyncedAt = $values['lastSyncedAt'] ?? null;
    $this->errorMessage = $values['errorMessage'] ?? null;

    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('enqueuedAt', $values)) {
      $this->_dirtyFields['enqueued_at'] = true;
    }
    if (array_key_exists('startedAt', $values)) {
      $this->_dirtyFields['started_at'] = true;
    }
    if (array_key_exists('completedAt', $values)) {
      $this->_dirtyFields['completed_at'] = true;
    }
    if (array_key_exists('lastSyncedAt', $values)) {
      $this->_dirtyFields['last_synced_at'] = true;
    }
    if (array_key_exists('errorMessage', $values)) {
      $this->_dirtyFields['error_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->enqueuedAt !== null) {
      $parts[] = [
        'name' => 'enqueued_at',
        'contents' => (string) $this->enqueuedAt
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

    if ($this->lastSyncedAt !== null) {
      $parts[] = [
        'name' => 'last_synced_at',
        'contents' => (string) $this->lastSyncedAt
      ];
    }

    if ($this->errorMessage !== null) {
      $parts[] = [
        'name' => 'error_message',
        'contents' => $this->errorMessage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
