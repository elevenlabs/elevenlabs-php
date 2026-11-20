<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Represents a time-of-day range (e.g., 09:00-17:00) commonly used for
 * working hours, available hours, or recurring schedules.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TimeRangeModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Start hour (0-23)
   */
  #[JsonProperty('start_hour', required: true)]
  public int $startHour;

  /**
   * Start minute (0-59)
   */
  #[JsonProperty('start_minute', required: true)]
  public int $startMinute;

  /**
   * End hour (0-24, where 24:00 means midnight end-of-day)
   */
  #[JsonProperty('end_hour', required: true)]
  public int $endHour;

  /**
   * End minute (0-59)
   */
  #[JsonProperty('end_minute', required: true)]
  public int $endMinute;

  /**
   * @param array{
   *   startHour: int,
   *   startMinute: int,
   *   endHour: int,
   *   endMinute: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->startHour = $values['startHour'];
    $this->startMinute = $values['startMinute'];
    $this->endHour = $values['endHour'];
    $this->endMinute = $values['endMinute'];

    $this->_dirtyFields = [
      'start_hour' => true,
      'start_minute' => true,
      'end_hour' => true,
      'end_minute' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start_hour',
      'contents' => (string) $this->startHour
    ];

    $parts[] = [
      'name' => 'start_minute',
      'contents' => (string) $this->startMinute
    ];

    $parts[] = [
      'name' => 'end_hour',
      'contents' => (string) $this->endHour
    ];

    $parts[] = [
      'name' => 'end_minute',
      'contents' => (string) $this->endMinute
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->startHour, 'start_hour', min: 0);
    Validator::validateNumber($this->startMinute, 'start_minute', min: 0);
    Validator::validateNumber($this->endHour, 'end_hour', min: 0, max: 24);
    Validator::validateNumber($this->endMinute, 'end_minute', min: 0);
  }
}
