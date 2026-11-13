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
class FrustratedConversationRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_id', required: true)]
  public string $conversationId;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('start_time_unix_secs', required: true)]
  public int $startTimeUnixSecs;

  /**
   * @var value-of<\ElevenLabs\Types\FrustratedConversationRefOverallLabel>
   */
  #[JsonProperty('overall_label', required: true)]
  public string $overallLabel;

  #[JsonProperty('overall_sentiment_score', required: true)]
  public float $overallSentimentScore;

  #[JsonProperty('overall_frustration_score', required: true)]
  public float $overallFrustrationScore;

  /**
   * @param array{
   *   conversationId: string,
   *   agentId: string,
   *   startTimeUnixSecs: int,
   *   overallLabel: value-of<\ElevenLabs\Types\FrustratedConversationRefOverallLabel>,
   *   overallSentimentScore: float,
   *   overallFrustrationScore: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationId = $values['conversationId'];
    $this->agentId = $values['agentId'];
    $this->startTimeUnixSecs = $values['startTimeUnixSecs'];
    $this->overallLabel = $values['overallLabel'];
    $this->overallSentimentScore = $values['overallSentimentScore'];
    $this->overallFrustrationScore = $values['overallFrustrationScore'];

    $this->_dirtyFields = [
      'conversation_id' => true,
      'agent_id' => true,
      'start_time_unix_secs' => true,
      'overall_label' => true,
      'overall_sentiment_score' => true,
      'overall_frustration_score' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'start_time_unix_secs',
      'contents' => (string) $this->startTimeUnixSecs
    ];

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

    return $parts;
  }

  public function validate(): void
  {
  }
}
