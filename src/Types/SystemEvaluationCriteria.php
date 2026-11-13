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
class SystemEvaluationCriteria extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('user_sentiment_score', required: true)]
  public float $userSentimentScore;

  #[JsonProperty('user_frustration_score', required: true)]
  public float $userFrustrationScore;

  /**
   * @param array{
   *   userSentimentScore: float,
   *   userFrustrationScore: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->userSentimentScore = $values['userSentimentScore'];
    $this->userFrustrationScore = $values['userFrustrationScore'];

    $this->_dirtyFields = [
      'user_sentiment_score' => true,
      'user_frustration_score' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'user_sentiment_score',
      'contents' => (string) $this->userSentimentScore
    ];

    $parts[] = [
      'name' => 'user_frustration_score',
      'contents' => (string) $this->userFrustrationScore
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->userSentimentScore, 'user_sentiment_score', min: -1, max: 1);
    Validator::validateNumber(
      $this->userFrustrationScore,
      'user_frustration_score',
      min: 0,
      max: 1
    );
  }
}
