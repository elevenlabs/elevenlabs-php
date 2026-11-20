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
class WorkspaceNow extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Represents a calendar date as individual numeric components.
   */
  #[JsonProperty('today', required: true)]
  public \ElevenLabs\Types\DateModel $today;

  /**
   * Current hour (0-23)
   */
  #[JsonProperty('hour', required: true)]
  public int $hour;

  /**
   * Current minute (0-59)
   */
  #[JsonProperty('minute', required: true)]
  public int $minute;

  /**
   * Unix timestamp in milliseconds when this was generated
   */
  #[JsonProperty('fetched_at_ms', required: true)]
  public int $fetchedAtMs;

  /**
   * @param array{
   *   today: \ElevenLabs\Types\DateModel,
   *   hour: int,
   *   minute: int,
   *   fetchedAtMs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->today = $values['today'];
    $this->hour = $values['hour'];
    $this->minute = $values['minute'];
    $this->fetchedAtMs = $values['fetchedAtMs'];

    $this->_dirtyFields = [
      'today' => true,
      'hour' => true,
      'minute' => true,
      'fetched_at_ms' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'today',
      'contents' => json_encode($this->today),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'hour',
      'contents' => (string) $this->hour
    ];

    $parts[] = [
      'name' => 'minute',
      'contents' => (string) $this->minute
    ];

    $parts[] = [
      'name' => 'fetched_at_ms',
      'contents' => (string) $this->fetchedAtMs
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->today->validate();
    Validator::validateNumber($this->hour, 'hour', min: 0);
    Validator::validateNumber($this->minute, 'minute', min: 0);
  }
}
