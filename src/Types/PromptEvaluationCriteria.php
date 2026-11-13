<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * An evaluation using the transcript and a prompt for a yes/no achieved answer
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PromptEvaluationCriteria extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The unique identifier for the evaluation criteria
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\PromptEvaluationCriteriaType>
   * The type of evaluation criteria
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * The prompt that the agent should use to evaluate the conversation
   */
  #[JsonProperty('conversation_goal_prompt', required: true)]
  public string $conversationGoalPrompt;

  /**
   * When evaluating the prompt, should the agent's knowledge base be used.
   */
  #[JsonProperty('use_knowledge_base')]
  public ?bool $useKnowledgeBase;

  /**
   * @var ?value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope')]
  public ?string $scope;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * LLM model to use for this evaluation criteria. If not set, uses agent's analysis_llm default.
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\CriteriaScoringMode>
   */
  #[JsonProperty('scoring_mode')]
  public ?string $scoringMode;

  /**
   * Maximum value of the numeric score scale (minimum is always 0). Only used when scoring_mode is 'numeric_uniform'.
   */
  #[JsonProperty('max_score')]
  public ?int $maxScore;

  /**
   * Optional free-text instructions describing how to assign values on the numeric scale. Only used when scoring_mode is 'numeric_uniform'.
   */
  #[JsonProperty('score_instructions')]
  public ?string $scoreInstructions;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   conversationGoalPrompt: string,
   *   type?: ?value-of<\ElevenLabs\Types\PromptEvaluationCriteriaType>,
   *   useKnowledgeBase?: ?bool,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   scoringMode?: ?value-of<\ElevenLabs\Types\CriteriaScoringMode>,
   *   maxScore?: ?int,
   *   scoreInstructions?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->type = $values['type'] ?? 'prompt';
    $this->conversationGoalPrompt = $values['conversationGoalPrompt'];
    $this->useKnowledgeBase = $values['useKnowledgeBase'] ?? null;
    $this->scope = $values['scope'] ?? null;
    $this->llm = $values['llm'] ?? null;
    $this->scoringMode = $values['scoringMode'] ?? null;
    $this->maxScore = $values['maxScore'] ?? null;
    $this->scoreInstructions = $values['scoreInstructions'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'conversation_goal_prompt' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('useKnowledgeBase', $values)) {
      $this->_dirtyFields['use_knowledge_base'] = true;
    }
    if (array_key_exists('scope', $values)) {
      $this->_dirtyFields['scope'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('scoringMode', $values)) {
      $this->_dirtyFields['scoring_mode'] = true;
    }
    if (array_key_exists('maxScore', $values)) {
      $this->_dirtyFields['max_score'] = true;
    }
    if (array_key_exists('scoreInstructions', $values)) {
      $this->_dirtyFields['score_instructions'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
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

    if ($this->scope !== null) {
      $parts[] = [
        'name' => 'scope',
        'contents' => $this->scope
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->scoringMode !== null) {
      $parts[] = [
        'name' => 'scoring_mode',
        'contents' => $this->scoringMode
      ];
    }

    if ($this->maxScore !== null) {
      $parts[] = [
        'name' => 'max_score',
        'contents' => (string) $this->maxScore
      ];
    }

    if ($this->scoreInstructions !== null) {
      $parts[] = [
        'name' => 'score_instructions',
        'contents' => $this->scoreInstructions
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
    Validator::validateString($this->scoreInstructions, 'score_instructions', maxLength: 2000);
  }
}
