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
class ConversationSentimentAnalysis extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ConversationSentimentAnalysisOverallLabel>
   */
  #[JsonProperty('overall_label', required: true)]
  public string $overallLabel;

  #[JsonProperty('overall_sentiment_score', required: true)]
  public float $overallSentimentScore;

  #[JsonProperty('overall_frustration_score', required: true)]
  public float $overallFrustrationScore;

  #[JsonProperty('min_user_sentiment_score', required: true)]
  public float $minUserSentimentScore;

  #[JsonProperty('max_user_frustration_score', required: true)]
  public float $maxUserFrustrationScore;

  #[JsonProperty('num_scored_user_turns', required: true)]
  public int $numScoredUserTurns;

  /**
   * @param array{
   *   overallLabel: value-of<\ElevenLabs\Types\ConversationSentimentAnalysisOverallLabel>,
   *   overallSentimentScore: float,
   *   overallFrustrationScore: float,
   *   minUserSentimentScore: float,
   *   maxUserFrustrationScore: float,
   *   numScoredUserTurns: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->overallLabel = $values['overallLabel'];
    $this->overallSentimentScore = $values['overallSentimentScore'];
    $this->overallFrustrationScore = $values['overallFrustrationScore'];
    $this->minUserSentimentScore = $values['minUserSentimentScore'];
    $this->maxUserFrustrationScore = $values['maxUserFrustrationScore'];
    $this->numScoredUserTurns = $values['numScoredUserTurns'];

    $this->_dirtyFields = [
      'overall_label' => true,
      'overall_sentiment_score' => true,
      'overall_frustration_score' => true,
      'min_user_sentiment_score' => true,
      'max_user_frustration_score' => true,
      'num_scored_user_turns' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'overall_label',
      'contents' => $this->overallLabel
    ];

    $parts[] = [
      'name' => 'overall_sentiment_score',
      'contents' => (string) $this->overallSentimentScore
    ];

    $parts[] = [
      'name' => 'overall_frustration_score',
      'contents' => (string) $this->overallFrustrationScore
    ];

    $parts[] = [
      'name' => 'min_user_sentiment_score',
      'contents' => (string) $this->minUserSentimentScore
    ];

    $parts[] = [
      'name' => 'max_user_frustration_score',
      'contents' => (string) $this->maxUserFrustrationScore
    ];

    $parts[] = [
      'name' => 'num_scored_user_turns',
      'contents' => (string) $this->numScoredUserTurns
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber(
      $this->overallSentimentScore,
      'overall_sentiment_score',
      min: -1,
      max: 1
    );
    Validator::validateNumber(
      $this->overallFrustrationScore,
      'overall_frustration_score',
      min: 0,
      max: 1
    );
    Validator::validateNumber(
      $this->minUserSentimentScore,
      'min_user_sentiment_score',
      min: -1,
      max: 1
    );
    Validator::validateNumber(
      $this->maxUserFrustrationScore,
      'max_user_frustration_score',
      min: 0,
      max: 1
    );
    Validator::validateNumber($this->numScoredUserTurns, 'num_scored_user_turns', min: 0);
  }
}
