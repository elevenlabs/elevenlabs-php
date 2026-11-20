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
class DateOverridePolicy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * First local date the override applies on.
   */
  #[JsonProperty('start_date', required: true)]
  public string $startDate;

  /**
   * Last local date the override applies on, inclusive.
   */
  #[JsonProperty('end_date', required: true)]
  public string $endDate;

  /**
   * @var \ElevenLabs\Types\CallingIntervalPolicy[]|null
   * Calling windows on every day from `start_date` to `end_date`, replacing the weekly ones. Empty means no calls on those days.
   */
  #[JsonProperty('intervals'), ArrayType([\ElevenLabs\Types\CallingIntervalPolicy::class])]
  public ?array $intervals;

  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @param array{
   *   startDate: string,
   *   endDate: string,
   *   intervals?: \ElevenLabs\Types\CallingIntervalPolicy[]|null,
   *   name?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startDate = $values['startDate'];
    $this->endDate = $values['endDate'];
    $this->intervals = $values['intervals'] ?? null;
    $this->name = $values['name'] ?? null;

    $this->_dirtyFields = [
      'start_date' => true,
      'end_date' => true
    ];
    if (array_key_exists('intervals', $values)) {
      $this->_dirtyFields['intervals'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_date',
      'contents' => $this->startDate
    ];

    $parts[] = [
      'name' => 'end_date',
      'contents' => $this->endDate
    ];

    if ($this->intervals !== null) {
      $parts[] = [
        'name' => 'intervals',
        'contents' => json_encode($this->intervals),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->intervals ?? [] as $item) {
      $item->validate();
    }
  }
}
