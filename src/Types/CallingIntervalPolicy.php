<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CallingIntervalPolicy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Local start time, as `HH:MM`.
   */
  #[JsonProperty('start', required: true)]
  public string $start;

  /**
   * Local end time, as `HH:MM`; `24:00` ends at midnight.
   */
  #[JsonProperty('end', required: true)]
  public string $end;

  /**
   * @param array{
   *   start: string,
   *   end: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->start = $values['start'];
    $this->end = $values['end'];

    $this->_dirtyFields = [
      'start' => true,
      'end' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'start',
      'contents' => $this->start
    ];

    $parts[] = [
      'name' => 'end',
      'contents' => $this->end
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->start, 'start', pattern: '^([01]\\d|2[0-3]):[0-5]\\d$');
    Validator::validateString($this->end, 'end', pattern: '^(([01]\\d|2[0-3]):[0-5]\\d|24:00)$');
  }
}
