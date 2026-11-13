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
class EvaluationCriteriaSummaryResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('result', required: true)]
  public string $result;

  #[JsonProperty('score')]
  public ?int $score;

  #[JsonProperty('max_score')]
  public ?int $maxScore;

  /**
   * @param array{
   *   result: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   score?: ?int,
   *   maxScore?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->result = $values['result'];
    $this->score = $values['score'] ?? null;
    $this->maxScore = $values['maxScore'] ?? null;

    $this->_dirtyFields = [
      'result' => true
    ];
    if (array_key_exists('score', $values)) {
      $this->_dirtyFields['score'] = true;
    }
    if (array_key_exists('maxScore', $values)) {
      $this->_dirtyFields['max_score'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'result',
      'contents' => $this->result
    ];

    if ($this->score !== null) {
      $parts[] = [
        'name' => 'score',
        'contents' => (string) $this->score
      ];
    }

    if ($this->maxScore !== null) {
      $parts[] = [
        'name' => 'max_score',
        'contents' => (string) $this->maxScore
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
