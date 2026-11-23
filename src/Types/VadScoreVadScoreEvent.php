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
class VadScoreVadScoreEvent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('vad_score', required: true)]
  public float $vadScore;

  /**
   * @param array{
   *   vadScore: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->vadScore = $values['vadScore'];

    $this->_dirtyFields = [
      'vad_score' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'vad_score',
      'contents' => (string) $this->vadScore
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
