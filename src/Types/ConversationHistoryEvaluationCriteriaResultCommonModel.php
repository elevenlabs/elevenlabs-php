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
class ConversationHistoryEvaluationCriteriaResultCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('criteria_id', required: true)]
  public string $criteriaId;

  /**
   * @var value-of<\ElevenLabs\Types\EvaluationSuccessResult>
   */
  #[JsonProperty('result', required: true)]
  public string $result;

  #[JsonProperty('rationale', required: true)]
  public string $rationale;

  /**
   * @var ?value-of<\ElevenLabs\Types\CriteriaScoringMode>
   */
  #[JsonProperty('scoring_mode')]
  public ?string $scoringMode;

  #[JsonProperty('score')]
  public ?int $score;

  #[JsonProperty('max_score')]
  public ?int $maxScore;

  /**
   * @param array{
   *   criteriaId: string,
   *   result: value-of<\ElevenLabs\Types\EvaluationSuccessResult>,
   *   rationale: string,
   *   scoringMode?: ?value-of<\ElevenLabs\Types\CriteriaScoringMode>,
   *   score?: ?int,
   *   maxScore?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->criteriaId = $values['criteriaId'];
    $this->result = $values['result'];
    $this->rationale = $values['rationale'];
    $this->scoringMode = $values['scoringMode'] ?? null;
    $this->score = $values['score'] ?? null;
    $this->maxScore = $values['maxScore'] ?? null;

    $this->_dirtyFields = [
      'criteria_id' => true,
      'result' => true,
      'rationale' => true
    ];
    if (array_key_exists('scoringMode', $values)) {
      $this->_dirtyFields['scoring_mode'] = true;
    }
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
      'name' => 'criteria_id',
      'contents' => $this->criteriaId
    ];

    $parts[] = [
      'name' => 'result',
      'contents' => $this->result
    ];

    $parts[] = [
      'name' => 'rationale',
      'contents' => $this->rationale
    ];

    if ($this->scoringMode !== null) {
      $parts[] = [
        'name' => 'scoring_mode',
        'contents' => $this->scoringMode
      ];
    }

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
