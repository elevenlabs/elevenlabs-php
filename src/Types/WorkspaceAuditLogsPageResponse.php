<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Paginated workspace audit log response.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WorkspaceAuditLogsPageResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkspaceAuditLogEntryResponse[]
   */
  #[
    JsonProperty('entries', required: true),
    ArrayType([\ElevenLabs\Types\WorkspaceAuditLogEntryResponse::class])
  ]
  public array $entries;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  #[JsonProperty('next_cursor', required: true)]
  public ?string $nextCursor;

  /**
   * @param array{
   *   entries: \ElevenLabs\Types\WorkspaceAuditLogEntryResponse[],
   *   hasMore: bool,
   *   nextCursor: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->entries = $values['entries'];
    $this->hasMore = $values['hasMore'];
    $this->nextCursor = $values['nextCursor'];

    $this->_dirtyFields = [
      'entries' => true,
      'has_more' => true,
      'next_cursor' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'entries',
      'contents' => json_encode($this->entries),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'next_cursor',
      'contents' => $this->nextCursor
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->entries as $item) {
      $item->validate();
    }
  }
}
