<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TopicMetricsAggregate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_count')]
  public ?int $conversationCount;

  #[JsonProperty('sentiment')]
  public ?\ElevenLabs\Types\TopicSentimentAggregate $sentiment;

  /**
   * @var \ElevenLabs\Types\TopicEvaluationCriteriaAggregate[]|null
   */
  #[
    JsonProperty('evaluation_criteria'),
    ArrayType([\ElevenLabs\Types\TopicEvaluationCriteriaAggregate::class])
  ]
  public ?array $evaluationCriteria;

  /**
   * @param array{
   *   conversationCount?: ?int,
   *   sentiment?: ?\ElevenLabs\Types\TopicSentimentAggregate,
   *   evaluationCriteria?: \ElevenLabs\Types\TopicEvaluationCriteriaAggregate[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->conversationCount = $values['conversationCount'] ?? null;
    $this->sentiment = $values['sentiment'] ?? null;
    $this->evaluationCriteria = $values['evaluationCriteria'] ?? null;

    if (array_key_exists('conversationCount', $values)) {
      $this->_dirtyFields['conversation_count'] = true;
    }
    if (array_key_exists('sentiment', $values)) {
      $this->_dirtyFields['sentiment'] = true;
    }
    if (array_key_exists('evaluationCriteria', $values)) {
      $this->_dirtyFields['evaluation_criteria'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->conversationCount !== null) {
      $parts[] = [
        'name' => 'conversation_count',
        'contents' => (string) $this->conversationCount
      ];
    }

    if ($this->sentiment !== null) {
      $parts[] = [
        'name' => 'sentiment',
        'contents' => json_encode($this->sentiment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->evaluationCriteria !== null) {
      $parts[] = [
        'name' => 'evaluation_criteria',
        'contents' => json_encode($this->evaluationCriteria),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sentiment?->validate();
    foreach ($this->evaluationCriteria ?? [] as $item) {
      $item->validate();
    }
  }
}
