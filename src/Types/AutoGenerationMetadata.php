<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * Metadata for an automatically generated simulation test.
 *
 * Tracks the origin and context of tests that were auto-generated from
 * conversations, including the source conversation, topic, and evaluation
 * criteria the test covers.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AutoGenerationMetadata extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Agent whose simulation library this test belongs to.
   */
  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  /**
   * Stable topic id (from topic discovery) this test covers.
   */
  #[JsonProperty('stable_topic_id', required: true)]
  public string $stableTopicId;

  /**
   * Evaluation criterion id this test targets.
   */
  #[JsonProperty('criteria_id', required: true)]
  public string $criteriaId;

  /**
   * Human-readable topic label at generation time.
   */
  #[JsonProperty('topic_label', required: true)]
  public string $topicLabel;

  /**
   * Conversation the test was generated from.
   */
  #[JsonProperty('source_conversation_id', required: true)]
  public string $sourceConversationId;

  /**
   * Unix timestamp (seconds) when the test was generated.
   */
  #[JsonProperty('generated_at_unix', required: true)]
  public int $generatedAtUnix;

  /**
   * @param array{
   *   agentId: string,
   *   stableTopicId: string,
   *   criteriaId: string,
   *   topicLabel: string,
   *   sourceConversationId: string,
   *   generatedAtUnix: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->stableTopicId = $values['stableTopicId'];
    $this->criteriaId = $values['criteriaId'];
    $this->topicLabel = $values['topicLabel'];
    $this->sourceConversationId = $values['sourceConversationId'];
    $this->generatedAtUnix = $values['generatedAtUnix'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'stable_topic_id' => true,
      'criteria_id' => true,
      'topic_label' => true,
      'source_conversation_id' => true,
      'generated_at_unix' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'stable_topic_id',
      'contents' => $this->stableTopicId
    ];

    $parts[] = [
      'name' => 'criteria_id',
      'contents' => $this->criteriaId
    ];

    $parts[] = [
      'name' => 'topic_label',
      'contents' => $this->topicLabel
    ];

    $parts[] = [
      'name' => 'source_conversation_id',
      'contents' => $this->sourceConversationId
    ];

    $parts[] = [
      'name' => 'generated_at_unix',
      'contents' => (string) $this->generatedAtUnix
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
