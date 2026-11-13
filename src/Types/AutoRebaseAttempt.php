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
class AutoRebaseAttempt extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AutoRebaseOutcome>
   */
  #[JsonProperty('outcome', required: true)]
  public string $outcome;

  /**
   * Unix seconds when the attempt ran
   */
  #[JsonProperty('attempted_at', required: true)]
  public int $attemptedAt;

  /**
   * @param array{
   *   outcome: value-of<\ElevenLabs\Types\AutoRebaseOutcome>,
   *   attemptedAt: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outcome = $values['outcome'];
    $this->attemptedAt = $values['attemptedAt'];

    $this->_dirtyFields = [
      'outcome' => true,
      'attempted_at' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'outcome',
      'contents' => $this->outcome
    ];

    $parts[] = [
      'name' => 'attempted_at',
      'contents' => (string) $this->attemptedAt
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
