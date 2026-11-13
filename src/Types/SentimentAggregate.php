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
class SentimentAggregate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('scored_conversation_count', required: true)]
  public int $scoredConversationCount;

  #[JsonProperty('positive_count', required: true)]
  public int $positiveCount;

  #[JsonProperty('neutral_count', required: true)]
  public int $neutralCount;

  #[JsonProperty('negative_count', required: true)]
  public int $negativeCount;

  #[JsonProperty('average_sentiment_score', required: true)]
  public ?float $averageSentimentScore;

  #[JsonProperty('average_frustration_score', required: true)]
  public ?float $averageFrustrationScore;

  #[JsonProperty('recent_scored_conversation_count', required: true)]
  public int $recentScoredConversationCount;

  #[JsonProperty('recent_positive_count', required: true)]
  public int $recentPositiveCount;

  #[JsonProperty('recent_neutral_count', required: true)]
  public int $recentNeutralCount;

  #[JsonProperty('recent_negative_count', required: true)]
  public int $recentNegativeCount;

  #[JsonProperty('recent_average_sentiment_score', required: true)]
  public ?float $recentAverageSentimentScore;

  #[JsonProperty('recent_average_frustration_score', required: true)]
  public ?float $recentAverageFrustrationScore;

  /**
   * @param array{
   *   scoredConversationCount: int,
   *   positiveCount: int,
   *   neutralCount: int,
   *   negativeCount: int,
   *   averageSentimentScore: ?float,
   *   averageFrustrationScore: ?float,
   *   recentScoredConversationCount: int,
   *   recentPositiveCount: int,
   *   recentNeutralCount: int,
   *   recentNegativeCount: int,
   *   recentAverageSentimentScore: ?float,
   *   recentAverageFrustrationScore: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->scoredConversationCount = $values['scoredConversationCount'];
    $this->positiveCount = $values['positiveCount'];
    $this->neutralCount = $values['neutralCount'];
    $this->negativeCount = $values['negativeCount'];
    $this->averageSentimentScore = $values['averageSentimentScore'];
    $this->averageFrustrationScore = $values['averageFrustrationScore'];
    $this->recentScoredConversationCount = $values['recentScoredConversationCount'];
    $this->recentPositiveCount = $values['recentPositiveCount'];
    $this->recentNeutralCount = $values['recentNeutralCount'];
    $this->recentNegativeCount = $values['recentNegativeCount'];
    $this->recentAverageSentimentScore = $values['recentAverageSentimentScore'];
    $this->recentAverageFrustrationScore = $values['recentAverageFrustrationScore'];

    $this->_dirtyFields = [
      'scored_conversation_count' => true,
      'positive_count' => true,
      'neutral_count' => true,
      'negative_count' => true,
      'average_sentiment_score' => true,
      'average_frustration_score' => true,
      'recent_scored_conversation_count' => true,
      'recent_positive_count' => true,
      'recent_neutral_count' => true,
      'recent_negative_count' => true,
      'recent_average_sentiment_score' => true,
      'recent_average_frustration_score' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'scored_conversation_count',
      'contents' => (string) $this->scoredConversationCount
    ];

    $parts[] = [
      'name' => 'positive_count',
      'contents' => (string) $this->positiveCount
    ];

    $parts[] = [
      'name' => 'neutral_count',
      'contents' => (string) $this->neutralCount
    ];

    $parts[] = [
      'name' => 'negative_count',
      'contents' => (string) $this->negativeCount
    ];

    $parts[] = [
      'name' => 'average_sentiment_score',
      'contents' => (string) $this->averageSentimentScore
    ];

    $parts[] = [
      'name' => 'average_frustration_score',
      'contents' => (string) $this->averageFrustrationScore
    ];

    $parts[] = [
      'name' => 'recent_scored_conversation_count',
      'contents' => (string) $this->recentScoredConversationCount
    ];

    $parts[] = [
      'name' => 'recent_positive_count',
      'contents' => (string) $this->recentPositiveCount
    ];

    $parts[] = [
      'name' => 'recent_neutral_count',
      'contents' => (string) $this->recentNeutralCount
    ];

    $parts[] = [
      'name' => 'recent_negative_count',
      'contents' => (string) $this->recentNegativeCount
    ];

    $parts[] = [
      'name' => 'recent_average_sentiment_score',
      'contents' => (string) $this->recentAverageSentimentScore
    ];

    $parts[] = [
      'name' => 'recent_average_frustration_score',
      'contents' => (string) $this->recentAverageFrustrationScore
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
