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
class InitializeConnectionGenerationConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var int[]|null
   */
  #[JsonProperty('chunk_length_schedule'), ArrayType(['integer'])]
  public ?array $chunkLengthSchedule;

  /**
   * @param array{
   *   chunkLengthSchedule?: int[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->chunkLengthSchedule = $values['chunkLengthSchedule'] ?? null;

    if (array_key_exists('chunkLengthSchedule', $values)) {
      $this->_dirtyFields['chunk_length_schedule'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->chunkLengthSchedule !== null) {
      foreach ($this->chunkLengthSchedule ?? [] as $item) {
        $parts[] = [
          'name' => 'chunk_length_schedule',
          'contents' => (string) $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
