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
class ChunkingOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Maximum chunk size in tokens. Null uses the inherited value.
   */
  #[JsonProperty('max_chunk_size', required: true)]
  public ?int $maxChunkSize;

  /**
   * Chunk overlap as a percentage of the chunk size. Null uses the inherited value.
   */
  #[JsonProperty('overlap_percentage', required: true)]
  public ?int $overlapPercentage;

  /**
   * @var string[]|null
   * Custom text separators used when splitting. Null uses the inherited value.
   */
  #[JsonProperty('custom_separators', required: true), ArrayType(['string'])]
  public ?array $customSeparators;

  /**
   * @param array{
   *   maxChunkSize: ?int,
   *   overlapPercentage: ?int,
   *   customSeparators: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->maxChunkSize = $values['maxChunkSize'];
    $this->overlapPercentage = $values['overlapPercentage'];
    $this->customSeparators = $values['customSeparators'];

    $this->_dirtyFields = [
      'max_chunk_size' => true,
      'overlap_percentage' => true,
      'custom_separators' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'max_chunk_size',
      'contents' => (string) $this->maxChunkSize
    ];

    $parts[] = [
      'name' => 'overlap_percentage',
      'contents' => (string) $this->overlapPercentage
    ];

    foreach ($this->customSeparators ?? [] as $item) {
      $parts[] = [
        'name' => 'custom_separators',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
