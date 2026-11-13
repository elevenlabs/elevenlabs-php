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
class RagDocumentIndexUsage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('used_bytes', required: true)]
  public int $usedBytes;

  /**
   * @param array{
   *   usedBytes: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->usedBytes = $values['usedBytes'];

    $this->_dirtyFields = [
      'used_bytes' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'used_bytes',
      'contents' => (string) $this->usedBytes
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
