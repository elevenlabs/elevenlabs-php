<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * A handle to one node in a workflow. Handles are cheap: all state lives in the {@see Workflow}.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class WorkflowNode extends WorkflowChain
{
  public function __construct(
    WorkflowGraph $graph,
    public readonly string $id,
    private readonly ?string $parentId = null,
  ) {
    parent::__construct($graph);
  }

  /** The API node type, e.g. "override_agent" or "tool". */
  public function type(): ?string
  {
    $model = $this->graph->nodes[$this->id] ?? null;
    return $model === null ? null : ($model['type'] ?? null);
  }

  /**
   * Opens a branch followed when `$condition` holds. A string is an LLM condition. `$back` is the
   * condition for coming back along the edge.
   */
  public function when(Condition|Expr|string $condition, Condition|Expr|string|null $back = null): WorkflowBranch
  {
    return WorkflowBranch::open($this->graph, $this->id, $condition, $back);
  }

  /**
   * Returns the node this handle was chained from, so a whole workflow can be written as one
   * chain. For a handle from `node(id)`, that is the source of the first edge into the node. The
   * start node, and a node nothing leads to, go up to the start node. Adds nothing.
   */
  public function up(): WorkflowNode
  {
    $parent = $this->parentId;
    if ($parent === null) {
      $parent = $this->graph->startId;
      foreach ($this->graph->edges as $edge) {
        if ($edge->target === $this->id && $edge->source !== $this->id) {
          $parent = $edge->source;
          break;
        }
      }
    }
    return new WorkflowNode($this->graph, $parent);
  }

  /** Opens the branch followed when every tool in this tool node succeeded. */
  public function onSuccess(?string $label = null): WorkflowBranch
  {
    return WorkflowBranch::open($this->graph, $this->id, Condition::success($label));
  }

  /** Opens the branch followed when any tool in this tool node failed. */
  public function onFailure(?string $label = null): WorkflowBranch
  {
    return WorkflowBranch::open($this->graph, $this->id, Condition::failure($label));
  }

  /**
   * Routes both outcomes of this tool node in one place. Same as calling `onSuccess()` then
   * `onFailure()`, so the success edge always comes first. Either may be omitted. Returns this node.
   *
   * @param null|callable(WorkflowBranch): mixed $success
   * @param null|callable(WorkflowBranch): mixed $failure
   */
  public function onResult(?callable $success = null, ?callable $failure = null): WorkflowNode
  {
    if ($success !== null) {
      $success($this->onSuccess());
    }
    if ($failure !== null) {
      $failure($this->onFailure());
    }
    return $this;
  }

  /**
   * Changes this node's options. Only options that apply to the node's kind may be set; `build()`
   * reports the rest.
   *
   * @param array<string, mixed>|\ElevenLabs\Types\PositionInput|null $position
   * @param list<string>|null $toolIds
   * @param list<mixed>|null $knowledgeBase
   * @param array<string, array<string, mixed>>|null $schemaOverrides
   * @param list<mixed>|null $customSipHeaders
   */
  public function update(
    ?string $prompt = null,
    ?array $toolIds = null,
    ?Destination $destination = null,
    mixed $position = null,
    ?string $label = null,
    ?array $knowledgeBase = null,
    mixed $conversationConfig = null,
    mixed $entryBehavior = null,
    ?array $schemaOverrides = null,
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
    $model = $this->graph->nodes[$this->id] ?? null;
    if ($model === null) {
      $this->graph->issue('unknown_node', "Can't update unknown node \"{$this->id}\"", $this->id);
      return $this;
    }
    $options = [
      'prompt' => $prompt,
      'tool_ids' => $toolIds,
      'destination' => $destination,
      'position' => $position,
      'label' => $label,
      'knowledge_base' => $knowledgeBase,
      'conversation_config' => $conversationConfig,
      'entry_behavior' => $entryBehavior,
      'schema_overrides' => $schemaOverrides,
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
    ];
    $this->graph->nodes[$this->id] = $this->graph->applyOptions($this->id, $model, $options);
    return $this;
  }

  protected function origin(): EdgeOrigin
  {
    return new EdgeOrigin($this->id, Condition::always()->toWire());
  }
}
