<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Represents a calendar date as individual numeric components.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DateModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Year
   */
  #[JsonProperty('year', required: true)]
  public int $year;

  /**
   * Month (1-12)
   */
  #[JsonProperty('month', required: true)]
  public int $month;

  /**
   * Day of month (1-31)
   */
  #[JsonProperty('day', required: true)]
  public int $day;

  /**
   * @param array{
   *   year: int,
   *   month: int,
   *   day: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->year = $values['year'];
    $this->month = $values['month'];
    $this->day = $values['day'];

    $this->_dirtyFields = [
      'year' => true,
      'month' => true,
      'day' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'year',
      'contents' => (string) $this->year
    ];

    $parts[] = [
      'name' => 'month',
      'contents' => (string) $this->month
    ];

    $parts[] = [
      'name' => 'day',
      'contents' => (string) $this->day
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->year, 'year', min: 2026, max: 2100);
    Validator::validateNumber($this->month, 'month', min: 1, max: 12);
    Validator::validateNumber($this->day, 'day', min: 1, max: 31);
  }
}
