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
class AudioOutputMultiAlignment extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   */
  #[JsonProperty('chars', required: true), ArrayType(['string'])]
  public array $chars;

  /**
   * @var int[]
   */
  #[JsonProperty('char_start_times_ms', required: true), ArrayType(['integer'])]
  public array $charStartTimesMs;

  /**
   * @var int[]
   */
  #[JsonProperty('char_durations_ms', required: true), ArrayType(['integer'])]
  public array $charDurationsMs;

  /**
   * @param array{
   *   chars: string[],
   *   charStartTimesMs: int[],
   *   charDurationsMs: int[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chars = $values['chars'];
    $this->charStartTimesMs = $values['charStartTimesMs'];
    $this->charDurationsMs = $values['charDurationsMs'];

    $this->_dirtyFields = [
      'chars' => true,
      'char_start_times_ms' => true,
      'char_durations_ms' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->chars as $item) {
      $parts[] = [
        'name' => 'chars',
        'contents' => $item
      ];
    }

    foreach ($this->charStartTimesMs as $item) {
      $parts[] = [
        'name' => 'char_start_times_ms',
        'contents' => (string) $item
      ];
    }

    foreach ($this->charDurationsMs as $item) {
      $parts[] = [
        'name' => 'char_durations_ms',
        'contents' => (string) $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
