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
class CallingPeriodPolicy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var int[]
   */
  #[JsonProperty('weekdays', required: true), ArrayType(['integer'])]
  public array $weekdays;

  /**
   * @var \ElevenLabs\Types\CallingIntervalPolicy[]
   * Windows on each of those days. They may not overlap on any day.
   */
  #[
    JsonProperty('intervals', required: true),
    ArrayType([\ElevenLabs\Types\CallingIntervalPolicy::class])
  ]
  public array $intervals;

  /**
   * @param array{
   *   weekdays: int[],
   *   intervals: \ElevenLabs\Types\CallingIntervalPolicy[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->weekdays = $values['weekdays'];
    $this->intervals = $values['intervals'];

    $this->_dirtyFields = [
      'weekdays' => true,
      'intervals' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->weekdays as $item) {
      $parts[] = [
        'name' => 'weekdays',
        'contents' => (string) $item
      ];
    }

    $parts[] = [
      'name' => 'intervals',
      'contents' => json_encode($this->intervals),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->weekdays, 'weekdays', minItems: 1);
    foreach ($this->intervals as $item) {
      $item->validate();
    }
    Validator::validateArray($this->intervals, 'intervals', minItems: 1);
  }
}
