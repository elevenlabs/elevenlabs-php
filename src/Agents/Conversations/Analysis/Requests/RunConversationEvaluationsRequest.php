<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Analysis\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RunConversationEvaluationsRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the single evaluation criterion to rerun.
   */
  #[JsonProperty('evaluation_id', required: true)]
  public string $evaluationId;

  /**
   * @var ?value-of<\ElevenLabs\Types\AnalysisScope>
   */
  #[JsonProperty('scope')]
  public ?string $scope;

  /**
   * ID of the agent whose evaluation result to rerun, for conversations that transferred between agents. If omitted, a conversation-scoped evaluation reruns for the agent that started the conversation.
   */
  #[JsonProperty('evaluated_agent_id')]
  public ?string $evaluatedAgentId;

  /**
   * Branch of `evaluated_agent_id` whose evaluation result to rerun, for conversations that visited the agent on more than one branch. If omitted, the result reruns for every branch of that agent.
   */
  #[JsonProperty('evaluated_branch_id')]
  public ?string $evaluatedBranchId;

  /**
   * @param array{
   *   evaluationId: string,
   *   scope?: ?value-of<\ElevenLabs\Types\AnalysisScope>,
   *   evaluatedAgentId?: ?string,
   *   evaluatedBranchId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->evaluationId = $values['evaluationId'];
    $this->scope = $values['scope'] ?? null;
    $this->evaluatedAgentId = $values['evaluatedAgentId'] ?? null;
    $this->evaluatedBranchId = $values['evaluatedBranchId'] ?? null;

    $this->_dirtyFields = [
      'evaluation_id' => true
    ];
    if (array_key_exists('scope', $values)) {
      $this->_dirtyFields['scope'] = true;
    }
    if (array_key_exists('evaluatedAgentId', $values)) {
      $this->_dirtyFields['evaluated_agent_id'] = true;
    }
    if (array_key_exists('evaluatedBranchId', $values)) {
      $this->_dirtyFields['evaluated_branch_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'evaluation_id',
      'contents' => $this->evaluationId
    ];

    if ($this->scope !== null) {
      $parts[] = [
        'name' => 'scope',
        'contents' => $this->scope
      ];
    }

    if ($this->evaluatedAgentId !== null) {
      $parts[] = [
        'name' => 'evaluated_agent_id',
        'contents' => $this->evaluatedAgentId
      ];
    }

    if ($this->evaluatedBranchId !== null) {
      $parts[] = [
        'name' => 'evaluated_branch_id',
        'contents' => $this->evaluatedBranchId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
