<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DoDubbingResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the dubbing project.
   */
  #[JsonProperty('dubbing_id', required: true)]
  public string $dubbingId;

  /**
   * The expected duration of the dubbing project in seconds.
   */
  #[JsonProperty('expected_duration_sec', required: true)]
  public float $expectedDurationSec;

  /**
   * @param array{
   *   dubbingId: string,
   *   expectedDurationSec: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dubbingId = $values['dubbingId'];
    $this->expectedDurationSec = $values['expectedDurationSec'];

    $this->_dirtyFields = [
      'dubbing_id' => true,
      'expected_duration_sec' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'dubbing_id',
      'contents' => $this->dubbingId
    ];

    $parts[] = [
      'name' => 'expected_duration_sec',
      'contents' => (string) $this->expectedDurationSec
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
