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
class UserFeedback extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\UserFeedbackScore>
   */
  #[JsonProperty('score', required: true)]
  public string $score;

  #[JsonProperty('time_in_call_secs', required: true)]
  public int $timeInCallSecs;

  /**
   * @param array{
   *   score: value-of<\ElevenLabs\Types\UserFeedbackScore>,
   *   timeInCallSecs: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->score = $values['score'];
    $this->timeInCallSecs = $values['timeInCallSecs'];

    $this->_dirtyFields = [
      'score' => true,
      'time_in_call_secs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'score',
      'contents' => $this->score
    ];

    $parts[] = [
      'name' => 'time_in_call_secs',
      'contents' => (string) $this->timeInCallSecs
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
