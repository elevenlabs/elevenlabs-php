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
class PendingBlocksMetadataModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('target_global_offset_ms', required: true)]
  public ?int $targetGlobalOffsetMs;

  /**
   * @var string[]
   */
  #[JsonProperty('block_ids', required: true), ArrayType(['string'])]
  public array $blockIds;

  /**
   * @param array{
   *   targetGlobalOffsetMs: ?int,
   *   blockIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetGlobalOffsetMs = $values['targetGlobalOffsetMs'];
    $this->blockIds = $values['blockIds'];

    $this->_dirtyFields = [
      'target_global_offset_ms' => true,
      'block_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'target_global_offset_ms',
      'contents' => (string) $this->targetGlobalOffsetMs
    ];

    foreach ($this->blockIds as $item) {
      $parts[] = [
        'name' => 'block_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
