<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * The verbs that add a node and connect it to the current point in the workflow. Each returns
 * the new node, so linear flows chain: `wf->converse(...)->when("...")->tool(...)`.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
abstract class WorkflowChain
{
  public function __construct(protected readonly WorkflowGraph $graph)
  {
  }

  abstract protected function origin(): EdgeOrigin;

  /**
   * The agent holds a conversation with `$prompt` added to its instructions until an outgoing
   * condition holds (a subagent node). `$label` defaults to `$id`.
   *
   * @param array<string, mixed>|\ElevenLabs\Types\PositionInput|null $position
   * @param list<mixed>|null $toolIds
   * @param list<mixed>|null $knowledgeBase
   */
  public function converse(
    string $id,
    string $prompt,
    mixed $position = null,
    ?string $label = null,
    ?array $toolIds = null,
    ?array $knowledgeBase = null,
    mixed $conversationConfig = null,
    mixed $entryBehavior = null,
  ): WorkflowNode {
    $model = $this->graph->applyOptions(
      $id,
      ['type' => 'override_agent', 'label' => $id, 'additional_prompt' => $prompt],
      [
        'position' => $position,
        'label' => $label,
        'tool_ids' => $toolIds,
        'knowledge_base' => $knowledgeBase,
        'conversation_config' => $conversationConfig,
        'entry_behavior' => $entryBehavior,
      ],
    );
    $this->graph->addNode($id, $model);
    return $this->connect($id);
  }

  /**
   * Runs the tools in parallel. Branch on the result with `onResult()`, or `onSuccess()` and
   * `onFailure()`.
   *
   * @param list<string> $toolIds
   * @param array<string, mixed>|\ElevenLabs\Types\PositionInput|null $position
   * @param array<string, array<string, mixed>>|null $schemaOverrides
   */
  public function tool(
    string $id,
    array $toolIds,
    mixed $position = null,
    ?array $schemaOverrides = null,
  ): WorkflowNode {
    $model = $this->graph->applyOptions(
      $id,
      ['type' => 'tool'],
      ['position' => $position, 'schema_overrides' => $schemaOverrides, 'tool_ids' => array_values($toolIds)],
    );
    $this->graph->addNode($id, $model);
    return $this->connect($id);
  }

  /**
   * Transfers the conversation to a phone number, SIP URI or another agent.
   *
   * @param array<string, mixed>|\ElevenLabs\Types\PositionInput|null $position
   * @param list<mixed>|null $customSipHeaders
   */
  public function transfer(
    string $id,
    Destination $destination,
    mixed $position = null,
    mixed $transferType = null,
    ?array $customSipHeaders = null,
    ?bool $sipReferPlayDialtone = null,
    mixed $uui = null,
    mixed $postDialDigits = null,
    ?int $delayMs = null,
    ?string $transferMessage = null,
    ?bool $enableTransferredAgentFirstMessage = null,
    ?bool $preserveClientTtsOverrides = null,
    ?bool $preserveVoiceSettings = null,
  ): WorkflowNode {
    $model = $this->graph->applyOptions(
      $id,
      $destination->toWire(),
      [
        'position' => $position,
        'transfer_type' => $transferType,
        'custom_sip_headers' => $customSipHeaders,
        'sip_refer_play_dialtone' => $sipReferPlayDialtone,
        'uui' => $uui,
        'post_dial_digits' => $postDialDigits,
        'delay_ms' => $delayMs,
        'transfer_message' => $transferMessage,
        'enable_transferred_agent_first_message' => $enableTransferredAgentFirstMessage,
        'preserve_client_tts_overrides' => $preserveClientTtsOverrides,
        'preserve_voice_settings' => $preserveVoiceSettings,
      ],
    );
    $this->graph->addNode($id, $model);
    return $this->connect($id);
  }

  /**
   * Ends the conversation. Every `end()` without an id shares one end node, `"end"`.
   *
   * @param array<string, mixed>|\ElevenLabs\Types\PositionInput|null $position
   */
  public function end(string $id = 'end', mixed $position = null): WorkflowNode
  {
    $this->graph->addNode($id, $this->graph->applyOptions($id, ['type' => 'end'], ['position' => $position]));
    return $this->connect($id);
  }

  /**
   * Moves the conversation to a node that already exists (or will by `build()` time), for merges
   * and loops. `$back` is the condition for coming back along this edge.
   */
  public function goTo(WorkflowNode|string $target, Condition|Expr|string|null $back = null): WorkflowNode
  {
    return $this->connect($target instanceof WorkflowNode ? $target->id : $target, $back);
  }

  protected function connect(string $target, Condition|Expr|string|null $back = null): WorkflowNode
  {
    $origin = $this->origin();
    $this->graph->edges[] = new GraphEdge(
      source: $origin->source,
      target: $target,
      forwardCondition: $origin->forwardCondition,
      backwardCondition: $back === null ? $origin->backwardCondition : Condition::from($back)->toWire(),
    );
    return new WorkflowNode($this->graph, $target, $origin->source);
  }
}
