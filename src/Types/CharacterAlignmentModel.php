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
class CharacterAlignmentModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('characters', required: true), ArrayType(['string'])]
  public array $characters;

  /**
   * @var float[]
   */
  #[JsonProperty('character_start_times_seconds', required: true), ArrayType(['float'])]
  public array $characterStartTimesSeconds;

  /**
   * @var float[]
   */
  #[JsonProperty('character_end_times_seconds', required: true), ArrayType(['float'])]
  public array $characterEndTimesSeconds;

  /**
   * @param array{
   *   characters: string[],
   *   characterStartTimesSeconds: float[],
   *   characterEndTimesSeconds: float[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->characters = $values['characters'];
    $this->characterStartTimesSeconds = $values['characterStartTimesSeconds'];
    $this->characterEndTimesSeconds = $values['characterEndTimesSeconds'];

    $this->_dirtyFields = [
      'characters' => true,
      'character_start_times_seconds' => true,
      'character_end_times_seconds' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->characters as $item) {
      $parts[] = [
        'name' => 'characters',
        'contents' => $item
      ];
    }

    foreach ($this->characterStartTimesSeconds as $item) {
      $parts[] = [
        'name' => 'character_start_times_seconds',
        'contents' => (string) $item
      ];
    }

    foreach ($this->characterEndTimesSeconds as $item) {
      $parts[] = [
        'name' => 'character_end_times_seconds',
        'contents' => (string) $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
