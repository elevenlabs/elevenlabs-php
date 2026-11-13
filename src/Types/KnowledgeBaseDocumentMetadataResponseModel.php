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
class KnowledgeBaseDocumentMetadataResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('created_at_unix_secs', required: true)]
  public int $createdAtUnixSecs;

  #[JsonProperty('last_updated_at_unix_secs', required: true)]
  public int $lastUpdatedAtUnixSecs;

  #[JsonProperty('size_bytes', required: true)]
  public int $sizeBytes;

  /**
   * @param array{
   *   createdAtUnixSecs: int,
   *   lastUpdatedAtUnixSecs: int,
   *   sizeBytes: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->createdAtUnixSecs = $values['createdAtUnixSecs'];
    $this->lastUpdatedAtUnixSecs = $values['lastUpdatedAtUnixSecs'];
    $this->sizeBytes = $values['sizeBytes'];

    $this->_dirtyFields = [
      'created_at_unix_secs' => true,
      'last_updated_at_unix_secs' => true,
      'size_bytes' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'created_at_unix_secs',
      'contents' => (string) $this->createdAtUnixSecs
    ];

    $parts[] = [
      'name' => 'last_updated_at_unix_secs',
      'contents' => (string) $this->lastUpdatedAtUnixSecs
    ];

    $parts[] = [
      'name' => 'size_bytes',
      'contents' => (string) $this->sizeBytes
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
