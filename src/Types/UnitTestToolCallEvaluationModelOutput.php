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
class UnitTestToolCallEvaluationModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\UnitTestToolCallParameter[]|null
   * Parameters to evaluate for the agent's tool call. If empty, the tool call parameters are not evaluated.
   */
  #[JsonProperty('parameters'), ArrayType([\ElevenLabs\Types\UnitTestToolCallParameter::class])]
  public ?array $parameters;

  /**
   * The tool to evaluate a call against.
   */
  #[JsonProperty('referenced_tool')]
  public ?\ElevenLabs\Types\ReferencedToolCommonModel $referencedTool;

  /**
   * Whether to verify that the tool was NOT called.
   */
  #[JsonProperty('verify_absence')]
  public ?bool $verifyAbsence;

  /**
   * Configuration for testing workflow node transitions. When set, the test will verify the agent transitions to the specified workflow node.
   */
  #[JsonProperty('workflow_node_transition')]
  public ?\ElevenLabs\Types\UnitTestWorkflowNodeTransitionEvaluationNodeId $workflowNodeTransition;

  /**
   * Evaluate guardrails triggered by the generated agent turn.
   */
  #[JsonProperty('guardrail_trigger')]
  public ?\ElevenLabs\Types\UnitTestGuardrailTriggerEvaluationModel $guardrailTrigger;

  /**
   * @param array{
   *   parameters?: \ElevenLabs\Types\UnitTestToolCallParameter[]|null,
   *   referencedTool?: ?\ElevenLabs\Types\ReferencedToolCommonModel,
   *   verifyAbsence?: ?bool,
   *   workflowNodeTransition?: ?\ElevenLabs\Types\UnitTestWorkflowNodeTransitionEvaluationNodeId,
   *   guardrailTrigger?: ?\ElevenLabs\Types\UnitTestGuardrailTriggerEvaluationModel,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->parameters = $values['parameters'] ?? null;
    $this->referencedTool = $values['referencedTool'] ?? null;
    $this->verifyAbsence = $values['verifyAbsence'] ?? null;
    $this->workflowNodeTransition = $values['workflowNodeTransition'] ?? null;
    $this->guardrailTrigger = $values['guardrailTrigger'] ?? null;

    if (array_key_exists('parameters', $values)) {
      $this->_dirtyFields['parameters'] = true;
    }
    if (array_key_exists('referencedTool', $values)) {
      $this->_dirtyFields['referenced_tool'] = true;
    }
    if (array_key_exists('verifyAbsence', $values)) {
      $this->_dirtyFields['verify_absence'] = true;
    }
    if (array_key_exists('workflowNodeTransition', $values)) {
      $this->_dirtyFields['workflow_node_transition'] = true;
    }
    if (array_key_exists('guardrailTrigger', $values)) {
      $this->_dirtyFields['guardrail_trigger'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->parameters !== null) {
      $parts[] = [
        'name' => 'parameters',
        'contents' => json_encode($this->parameters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->referencedTool !== null) {
      $parts[] = [
        'name' => 'referenced_tool',
        'contents' => json_encode($this->referencedTool),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->verifyAbsence !== null) {
      $parts[] = [
        'name' => 'verify_absence',
        'contents' => $this->verifyAbsence ? 'true' : 'false'
      ];
    }

    if ($this->workflowNodeTransition !== null) {
      $parts[] = [
        'name' => 'workflow_node_transition',
        'contents' => json_encode($this->workflowNodeTransition),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->guardrailTrigger !== null) {
      $parts[] = [
        'name' => 'guardrail_trigger',
        'contents' => json_encode($this->guardrailTrigger),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->parameters ?? [] as $item) {
      $item->validate();
    }
    $this->referencedTool?->validate();
    $this->workflowNodeTransition?->validate();
    $this->guardrailTrigger?->validate();
  }
}
