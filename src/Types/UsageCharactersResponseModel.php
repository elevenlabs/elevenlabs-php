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
class UsageCharactersResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var int[]
   * The time axis with unix timestamps for each day.
   */
  #[JsonProperty('time', required: true), ArrayType(['integer'])]
  public array $time;

  /**
   * @var array<string, float[]>
   * The usage of each breakdown type along the time axis.
   */
  #[JsonProperty('usage', required: true), ArrayType(['string' => ['float']])]
  public array $usage;

  /**
   * @param array{
   *   time: int[],
   *   usage: array<string, float[]>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->time = $values['time'];
    $this->usage = $values['usage'];

    $this->_dirtyFields = [
      'time' => true,
      'usage' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->time as $item) {
      $parts[] = [
        'name' => 'time',
        'contents' => (string) $item
      ];
    }

    $parts[] = [
      'name' => 'usage',
      'contents' => json_encode($this->usage),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
