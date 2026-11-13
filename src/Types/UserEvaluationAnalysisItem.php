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
class UserEvaluationAnalysisItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserEvaluationAnalysisItemSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * LLM to use for this item. If unset, the attaching agent's analysis_llm default is used.
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\UserEvaluationAnalysisItemKind>
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * The prompt used to evaluate the conversation.
   */
  #[JsonProperty('conversation_goal_prompt', required: true)]
  public string $conversationGoalPrompt;

  /**
   * Whether the attaching agent's knowledge base is used when evaluating this criterion.
   */
  #[JsonProperty('use_knowledge_base')]
  public ?bool $useKnowledgeBase;

  /**
   * How this criterion is scored (binary or numeric_uniform).
   */
  #[JsonProperty('scoring')]
  public ?\ElevenLabs\Types\UserEvaluationAnalysisItemScoring $scoring;

  /**
   * @param array{
   *   name: string,
   *   conversationGoalPrompt: string,
   *   source?: ?value-of<\ElevenLabs\Types\UserEvaluationAnalysisItemSource>,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   kind?: ?value-of<\ElevenLabs\Types\UserEvaluationAnalysisItemKind>,
   *   useKnowledgeBase?: ?bool,
   *   scoring?: ?\ElevenLabs\Types\UserEvaluationAnalysisItemScoring,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->source = $values['source'] ?? 'user';
    $this->llm = $values['llm'] ?? null;
    $this->kind = $values['kind'] ?? 'evaluation';
    $this->conversationGoalPrompt = $values['conversationGoalPrompt'];
    $this->useKnowledgeBase = $values['useKnowledgeBase'] ?? null;
    $this->scoring = $values['scoring'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'conversation_goal_prompt' => true
    ];
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('useKnowledgeBase', $values)) {
      $this->_dirtyFields['use_knowledge_base'] = true;
    }
    if (array_key_exists('scoring', $values)) {
      $this->_dirtyFields['scoring'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    $parts[] = [
      'name' => 'conversation_goal_prompt',
      'contents' => $this->conversationGoalPrompt
    ];

    if ($this->useKnowledgeBase !== null) {
      $parts[] = [
        'name' => 'use_knowledge_base',
        'contents' => $this->useKnowledgeBase ? 'true' : 'false'
      ];
    }

    if ($this->scoring !== null) {
      $parts[] = [
        'name' => 'scoring',
        'contents' => json_encode($this->scoring),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->conversationGoalPrompt,
      'conversation_goal_prompt',
      maxLength: 2000
    );
  }
}
