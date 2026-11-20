<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ChunkingOverrideRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Maximum chunk size in tokens. Null inherits from ancestors or the embedding model default.
   */
  #[JsonProperty('max_chunk_size')]
  public ?int $maxChunkSize;

  /**
   * Chunk overlap as a percentage of the final chunk size, applied after the chunk size is clamped to the embedding model. Null inherits from ancestors or the embedding model default.
   */
  #[JsonProperty('overlap_percentage')]
  public ?int $overlapPercentage;

  /**
   * @var string[]|null
   * Custom text separators used when splitting. Null inherits from ancestors; an empty list clears inherited separators.
   */
  #[JsonProperty('custom_separators'), ArrayType(['string'])]
  public ?array $customSeparators;

  /**
   * @param array{
   *   maxChunkSize?: ?int,
   *   overlapPercentage?: ?int,
   *   customSeparators?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->maxChunkSize = $values['maxChunkSize'] ?? null;
    $this->overlapPercentage = $values['overlapPercentage'] ?? null;
    $this->customSeparators = $values['customSeparators'] ?? null;

    if (array_key_exists('maxChunkSize', $values)) {
      $this->_dirtyFields['max_chunk_size'] = true;
    }
    if (array_key_exists('overlapPercentage', $values)) {
      $this->_dirtyFields['overlap_percentage'] = true;
    }
    if (array_key_exists('customSeparators', $values)) {
      $this->_dirtyFields['custom_separators'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->maxChunkSize !== null) {
      $parts[] = [
        'name' => 'max_chunk_size',
        'contents' => (string) $this->maxChunkSize
      ];
    }

    if ($this->overlapPercentage !== null) {
      $parts[] = [
        'name' => 'overlap_percentage',
        'contents' => (string) $this->overlapPercentage
      ];
    }

    if ($this->customSeparators !== null) {
      foreach ($this->customSeparators ?? [] as $item) {
        $parts[] = [
          'name' => 'custom_separators',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->maxChunkSize, 'max_chunk_size', min: 200);
    Validator::validateNumber($this->overlapPercentage, 'overlap_percentage', min: 0, max: 25);
    Validator::validateArray($this->customSeparators, 'custom_separators', maxItems: 5);
  }
}
