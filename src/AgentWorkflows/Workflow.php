<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

use ElevenLabs\Types\AgentWorkflowRequestModel;

/**
 * An agent workflow, written as code. The workflow itself is the start node: calling a verb on
 * it branches from the start.
 *
 *     use ElevenLabs\AgentWorkflows\Destination;
 *     use ElevenLabs\AgentWorkflows\Workflow;
 *
 *     $wf = new Workflow();
 *     $triage = $wf->converse("triage", "Find out what the caller needs");
 *     $lookup = $triage->when("Caller gave an order number")->tool("lookup_order", ["tool_123"]);
 *     $lookup->onResult(
 *         success: fn($ok) => $ok->converse("resolve", "Explain the order status")->end(),
 *         failure: fn($failed) => $failed->transfer("human", Destination::phone("+15551234567")),
 *     );
 *     $client->agents->update($agentId, ['workflow' => $wf->build()]);
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class Workflow extends WorkflowChain
{
  public function __construct(?bool $preventSubagentLoops = null)
  {
    parent::__construct(new WorkflowGraph());
    $this->graph->addNode($this->graph->startId, ['type' => 'start']);
    $this->graph->preventSubagentLoops = $preventSubagentLoops;
  }

  /**
   * Loads the workflow of an existing agent so it can be edited. Accepts the result of
   * `agents->get()`, its `workflow` field, or the equivalent wire-format array.
   */
  public static function fromAgent(mixed $agent): self
  {
    $wire = Wire::toWire($agent);
    $workflow = (is_array($wire) && array_key_exists('nodes', $wire))
      ? $wire
      : (is_array($wire) ? ($wire['workflow'] ?? null) : null);
    $wf = new self();
    if (is_array($workflow)) {
      $wf->graph->load($workflow);
    }
    return $wf;
  }

  /**
   * Loads a workflow stored as API-format JSON (snake_case): a JSON string or a parsed array,
   * holding either the workflow itself or a whole agent config with a `workflow` key.
   *
   * @param string|array<string, mixed> $data
   */
  public static function fromJson(string|array $data): self
  {
    /** @var mixed $parsed */
    $parsed = is_string($data) ? json_decode($data, true, 512, JSON_THROW_ON_ERROR) : $data;
    $raw = (is_array($parsed) && array_key_exists('workflow', $parsed)) ? $parsed['workflow'] : $parsed;
    $wf = new self();
    $wf->graph->load(is_array($raw) ? $raw : []);
    return $wf;
  }

  /** The id of the start node: `"start_node"`, or whatever a loaded workflow uses. */
  public function startId(): string
  {
    return $this->graph->startId;
  }

  /**
   * Ids of every node, in the order they were added.
   *
   * @return list<string>
   */
  public function nodeIds(): array
  {
    return array_map('strval', array_keys($this->graph->nodes));
  }

  /** Opens a branch from the start node, followed when `$condition` holds. */
  public function when(Condition|Expr|string $condition, Condition|Expr|string|null $back = null): WorkflowBranch
  {
    return WorkflowBranch::open($this->graph, $this->graph->startId, $condition, $back);
  }

  /** A handle to an existing node, for editing it or going to it. */
  public function node(string $id): WorkflowNode
  {
    if (!isset($this->graph->nodes[$id])) {
      $this->graph->issue('unknown_node', "There is no node \"{$id}\"", $id);
    }
    return new WorkflowNode($this->graph, $id);
  }

  /** Removes a node and every edge to or from it. */
  public function remove(string $id): self
  {
    $graph = $this->graph;
    if ($id === $graph->startId) {
      $graph->issue('cannot_remove_start', "The start node can't be removed", $id);
      return $this;
    }
    unset($graph->nodes[$id]);
    $graph->edges = array_values(array_filter(
      $graph->edges,
      static fn(GraphEdge $edge): bool => $edge->source !== $id && $edge->target !== $id
    ));
    return $this;
  }

  /**
   * Splices new nodes into the edge from `$sourceId` to `$targetId`. `$insert` receives a branch
   * carrying that edge's conditions and returns the last new node, which is connected to
   * `$targetId`. Returns that node, or null if there is no such edge or `$insert` returned
   * nothing; `build()` reports both.
   *
   * @param callable(WorkflowBranch): (WorkflowNode|null) $insert
   */
  public function insertBetween(string $sourceId, string $targetId, callable $insert): ?WorkflowNode
  {
    $graph = $this->graph;
    $index = null;
    foreach ($graph->edges as $i => $edge) {
      if ($edge->source === $sourceId && $edge->target === $targetId) {
        $index = $i;
        break;
      }
    }
    if ($index === null) {
      $graph->issue('unknown_edge', "There is no edge from \"{$sourceId}\" to \"{$targetId}\" to insert into", $sourceId);
      return null;
    }
    $original = $graph->edges[$index];
    array_splice($graph->edges, $index, 1);
    $before = count($graph->edges);
    $last = $insert(new WorkflowBranch(
      $graph,
      new EdgeOrigin(
        source: $sourceId,
        forwardCondition: $original->forwardCondition ?? Condition::always()->toWire(),
        backwardCondition: $original->backwardCondition,
      ),
    ));

    $firstHop = null;
    for ($i = $before, $n = count($graph->edges); $i < $n; $i++) {
      if ($graph->edges[$i]->source === $sourceId) {
        $firstHop = $i;
        break;
      }
    }
    if ($firstHop !== null) {
      $edge = $graph->edges[$firstHop];
      array_splice($graph->edges, $firstHop, 1);
      array_splice($graph->edges, $index, 0, [$edge]);
      if (isset($graph->loadedOrder[$sourceId])) {
        foreach ($graph->loadedOrder[$sourceId] as $slot => $loadedEdge) {
          if ($loadedEdge === $original) {
            $graph->loadedOrder[$sourceId][$slot] = $edge;
            break;
          }
        }
      }
    }

    if (!($last instanceof WorkflowNode)) {
      $graph->issue(
        'missing_insert_result',
        "insert_between(\"{$sourceId}\", \"{$targetId}\") must return the last inserted node",
        $sourceId
      );
      return null;
    }
    if ($last->type() === 'tool') {
      $last->onSuccess()->goTo($targetId);
    } else {
      $last->goTo($targetId);
    }
    return $last;
  }

  /**
   * Validates the workflow and returns it as the model `agents->create()`/`agents->update()`
   * accept. `$onWarning` is called for each non-fatal problem.
   *
   * @param null|callable(WorkflowIssue): mixed $onWarning
   * @throws WorkflowValidationError
   */
  public function build(?callable $onWarning = null): AgentWorkflowRequestModel
  {
    $wire = $this->toWireInternal($onWarning);
    return AgentWorkflowRequestModel::fromJson((string) json_encode($wire));
  }

  /**
   * The workflow in API format (snake_case keys, sorted at every level). Validates like `build()`.
   */
  public function toJson(): mixed
  {
    return Wire::canonical($this->toWireInternal(null));
  }

  /** `toJson()` as a string with 2-space indentation and a trailing newline. */
  public function toJsonString(): string
  {
    return Wire::encode($this->toJson());
  }

  protected function origin(): EdgeOrigin
  {
    return new EdgeOrigin($this->graph->startId, Condition::always()->toWire());
  }

  /**
   * @param null|callable(WorkflowIssue): mixed $onWarning
   * @return array<string, mixed>
   */
  private function toWireInternal(?callable $onWarning): array
  {
    $graph = $this->graph;
    $issues = Validate::validate($graph);
    $errors = array_values(array_filter($issues, static fn(WorkflowIssue $i): bool => $i->severity === 'error'));
    if ($errors !== []) {
      throw new WorkflowValidationError($errors);
    }
    if ($onWarning !== null) {
      foreach ($issues as $issue) {
        if ($issue->severity === 'warning') {
          $onWarning($issue);
        }
      }
    }

    $merges = Validate::reverseEdgeMerges($graph);
    $kept = [];
    foreach ($graph->edges as $i => $edge) {
      if (!isset($merges[$i])) {
        $kept[] = $edge;
      }
    }
    $ids = self::assignEdgeIds($kept);
    $idOf = new \SplObjectStorage();
    foreach ($kept as $k => $edge) {
      $idOf[$edge] = $ids[$k];
    }

    $positions = Layout::layout($graph);
    /** @var array<string, list<GraphEdge>> $outgoing */
    $outgoing = [];
    /** @var array<string, array<string, mixed>> $edgesWire */
    $edgesWire = [];
    foreach ($graph->edges as $i => $edge) {
      $into = $merges[$i] ?? null;
      if ($into !== null) {
        $reverse = $graph->edges[$into];
        $outgoing[$edge->source][] = $reverse;
        $edgesWire[$idOf[$reverse]]['backward_condition'] = $edge->forwardCondition;
        continue;
      }
      $outgoing[$edge->source][] = $edge;
      if ($edge->backwardCondition !== null) {
        $outgoing[$edge->target][] = $edge;
      }
      $wire = $edge->extra;
      $wire['source'] = $edge->source;
      $wire['target'] = $edge->target;
      if ($edge->forwardCondition !== null) {
        $wire['forward_condition'] = $edge->forwardCondition;
      }
      if ($edge->backwardCondition !== null) {
        $wire['backward_condition'] = $edge->backwardCondition;
      }
      $edgesWire[$idOf[$edge]] = $wire;
    }

    $nodesWire = [];
    foreach ($graph->nodes as $nodeId => $model) {
      $edgeOrderEdges = self::edgeOrder($graph->loadedOrder[(string) $nodeId] ?? [], $outgoing[(string) $nodeId] ?? []);
      $orderIds = [];
      foreach ($edgeOrderEdges as $edge) {
        $orderIds[] = $idOf[$edge];
      }
      $nodesWire[(string) $nodeId] = array_merge(
        $model,
        ['position' => $positions[(string) $nodeId], 'edge_order' => $orderIds]
      );
    }

    $workflow = ['nodes' => $nodesWire, 'edges' => $edgesWire === [] ? new \stdClass() : $edgesWire];
    if ($graph->preventSubagentLoops !== null) {
      $workflow['prevent_subagent_loops'] = $graph->preventSubagentLoops;
    }
    /** @var array<string, mixed> $copy */
    $copy = Wire::deepCopy($workflow);
    return $copy;
  }

  /**
   * A loaded node's order for the edges it still has, then any others in edge-list order.
   *
   * @param list<GraphEdge> $loaded
   * @param list<GraphEdge> $current
   * @return list<GraphEdge>
   */
  private static function edgeOrder(array $loaded, array $current): array
  {
    $kept = [];
    foreach ($loaded as $edge) {
      if (self::contains($current, $edge)) {
        $kept[] = $edge;
      }
    }
    $result = $kept;
    foreach ($current as $edge) {
      if (!self::contains($kept, $edge)) {
        $result[] = $edge;
      }
    }
    return $result;
  }

  /**
   * @param list<GraphEdge> $list
   */
  private static function contains(array $list, GraphEdge $edge): bool
  {
    foreach ($list as $candidate) {
      if ($candidate === $edge) {
        return true;
      }
    }
    return false;
  }

  /**
   * Loaded edges keep their ids. New ones get `source__target`, with `__2`, `__3`… on collision.
   *
   * @param list<GraphEdge> $edges
   * @return list<string>
   */
  private static function assignEdgeIds(array $edges): array
  {
    $taken = [];
    foreach ($edges as $edge) {
      if ($edge->id !== null) {
        $taken[$edge->id] = true;
      }
    }
    $ids = [];
    foreach ($edges as $edge) {
      if ($edge->id !== null) {
        $ids[] = $edge->id;
        continue;
      }
      $base = "{$edge->source}__{$edge->target}";
      $edgeId = $base;
      $n = 2;
      while (isset($taken[$edgeId])) {
        $edgeId = "{$base}__{$n}";
        $n++;
      }
      $taken[$edgeId] = true;
      $ids[] = $edgeId;
    }
    return $ids;
  }
}
