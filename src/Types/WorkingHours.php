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
class WorkingHours extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, \ElevenLabs\Types\TimeRangeModel[]>|null
   * Open time ranges per day of the week, keyed 0 (Monday) to 6 (Sunday). A day with no ranges is closed.
   */
  #[JsonProperty('hours'), ArrayType(['string' => [\ElevenLabs\Types\TimeRangeModel::class]])]
  public ?array $hours;

  /**
   * Timezone of these hours. Null uses the business's timezone.
   */
  #[JsonProperty('timezone')]
  public ?string $timezone;

  /**
   * @param array{
   *   hours?: array<string, \ElevenLabs\Types\TimeRangeModel[]>|null,
   *   timezone?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->hours = $values['hours'] ?? null;
    $this->timezone = $values['timezone'] ?? null;

    if (array_key_exists('hours', $values)) {
      $this->_dirtyFields['hours'] = true;
    }
    if (array_key_exists('timezone', $values)) {
      $this->_dirtyFields['timezone'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->hours !== null) {
      $parts[] = [
        'name' => 'hours',
        'contents' => json_encode($this->hours),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->timezone !== null) {
      $parts[] = [
        'name' => 'timezone',
        'contents' => $this->timezone
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
