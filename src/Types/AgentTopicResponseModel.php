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
class AgentTopicResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('topic_id', required: true)]
  public string $topicId;

  #[JsonProperty('label', required: true)]
  public string $label;

  #[JsonProperty('description', required: true)]
  public string $description;

  #[JsonProperty('conversation_count', required: true)]
  public int $conversationCount;

  #[JsonProperty('parent_topic_id')]
  public ?string $parentTopicId;

  #[JsonProperty('x_2d')]
  public ?float $x2D;

  #[JsonProperty('y_2d')]
  public ?float $y2D;

  #[JsonProperty('metrics')]
  public ?\ElevenLabs\Types\TopicMetricsAggregate $metrics;

  /**
   * Success rate across the topic's evaluation criteria, weighted by scored conversations. Returned regardless of include_evaluation_criteria.
   */
  #[JsonProperty('success_rate')]
  public ?float $successRate;

  /**
   * @param array{
   *   topicId: string,
   *   label: string,
   *   description: string,
   *   conversationCount: int,
   *   parentTopicId?: ?string,
   *   x2D?: ?float,
   *   y2D?: ?float,
   *   metrics?: ?\ElevenLabs\Types\TopicMetricsAggregate,
   *   successRate?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->topicId = $values['topicId'];
    $this->label = $values['label'];
    $this->description = $values['description'];
    $this->conversationCount = $values['conversationCount'];
    $this->parentTopicId = $values['parentTopicId'] ?? null;
    $this->x2D = $values['x2D'] ?? null;
    $this->y2D = $values['y2D'] ?? null;
    $this->metrics = $values['metrics'] ?? null;
    $this->successRate = $values['successRate'] ?? null;

    $this->_dirtyFields = [
      'topic_id' => true,
      'label' => true,
      'description' => true,
      'conversation_count' => true
    ];
    if (array_key_exists('parentTopicId', $values)) {
      $this->_dirtyFields['parent_topic_id'] = true;
    }
    if (array_key_exists('x2D', $values)) {
      $this->_dirtyFields['x_2d'] = true;
    }
    if (array_key_exists('y2D', $values)) {
      $this->_dirtyFields['y_2d'] = true;
    }
    if (array_key_exists('metrics', $values)) {
      $this->_dirtyFields['metrics'] = true;
    }
    if (array_key_exists('successRate', $values)) {
      $this->_dirtyFields['success_rate'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'topic_id',
      'contents' => $this->topicId
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    $parts[] = [
      'name' => 'conversation_count',
      'contents' => (string) $this->conversationCount
    ];

    if ($this->parentTopicId !== null) {
      $parts[] = [
        'name' => 'parent_topic_id',
        'contents' => $this->parentTopicId
      ];
    }

    if ($this->x2D !== null) {
      $parts[] = [
        'name' => 'x_2d',
        'contents' => (string) $this->x2D
      ];
    }

    if ($this->y2D !== null) {
      $parts[] = [
        'name' => 'y_2d',
        'contents' => (string) $this->y2D
      ];
    }

    if ($this->metrics !== null) {
      $parts[] = [
        'name' => 'metrics',
        'contents' => json_encode($this->metrics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->successRate !== null) {
      $parts[] = [
        'name' => 'success_rate',
        'contents' => (string) $this->successRate
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->metrics?->validate();
  }
}
