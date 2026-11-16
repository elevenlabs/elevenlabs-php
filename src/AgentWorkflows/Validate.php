<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Whole-graph validation and the graph walks `build()` depends on. Problems found while
 * chaining already live in `graph->issues`; these are the checks that need the finished graph.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class Validate
{
  /**
   * @return list<WorkflowIssue>
   */
  public static function validate(WorkflowGraph $graph): array
  {
    $issues = $graph->issues;
    $endsWithEdges = [];
    $error = static function (string $code, string $message, string $nodeId) use (&$issues): void {
      $issues[] = new WorkflowIssue($code, 'error', $message, $nodeId);
    };

    $merged = self::reverseEdgeMerges($graph);
    $connected = [];
    foreach ($graph->edges as $i => $edge) {
      if (isset($merged[$i])) {
        continue;
      }
      $pair = self::pairKey($edge->source, $edge->target);
      if (isset($connected[$pair])) {
        $error(
          'duplicate_edge',
          "Edge \"{$edge->source}\" → \"{$edge->target}\" connects two nodes that already have an edge "
            . 'between them, and the API allows only one. Give the existing edge a different condition, or remove one',
          $edge->source
        );
      }
      $connected[$pair] = true;
    }

    foreach ($graph->edges as $edge) {
      $name = "\"{$edge->source}\" → \"{$edge->target}\"";
      if ($edge->source === $edge->target) {
        $error('self_loop', "Edge {$name} connects a node to itself, which the API doesn't allow", $edge->source);
      }
      foreach ([$edge->source, $edge->target] as $id) {
        if (!isset($graph->nodes[$id])) {
          $error('unknown_node', "Edge {$name} refers to unknown node \"{$id}\"", $id);
        }
      }
      if ($edge->target === $graph->startId) {
        $error(
          'edge_into_start',
          "Edge {$name} points into the start node; go to the first node after it instead",
          $edge->source
        );
      }

      $sourceType = $graph->nodes[$edge->source]['type'] ?? null;
      $conditionType = $edge->forwardCondition['type'] ?? null;
      if ($sourceType === 'end' && !isset($endsWithEdges[$edge->source])) {
        $endsWithEdges[$edge->source] = true;
        $error('end_has_outgoing_edges', "End node \"{$edge->source}\" can't have outgoing edges", $edge->source);
      }
      if ($sourceType === 'tool' && $conditionType !== 'result') {
        $error(
          'tool_edge_needs_result',
          "Edge {$name} leaves a tool node, so it must use on_success() or on_failure()",
          $edge->source
        );
      }
      if ($sourceType !== null && $sourceType !== 'tool' && $conditionType === 'result') {
        $error(
          'result_edge_needs_tool',
          "Edge {$name} uses on_success()/on_failure(), which only applies to tool nodes",
          $edge->source
        );
      }
    }

    foreach ($graph->nodes as $id => $model) {
      if (!NodeTypes::modelKnowsNodeType($model['type'] ?? null)) {
        $type = is_string($model['type'] ?? null) ? $model['type'] : 'null';
        $issues[] = new WorkflowIssue(
          'unknown_node_type',
          'warning',
          "Node \"{$id}\" has type \"{$type}\", which this SDK version doesn't model. build() keeps it as given "
            . 'but agents.create()/agents.update() may reject it; upgrade the SDK, or send toJson() directly.',
          (string) $id
        );
      }
    }

    $reachable = self::depthsFrom($graph);
    foreach ($graph->nodes as $id => $model) {
      if (!isset($reachable[$id])) {
        $issues[] = new WorkflowIssue(
          'unreachable_node',
          'warning',
          "Node \"{$id}\" can't be reached from the start node",
          (string) $id
        );
      }
    }
    return $issues;
  }

  /**
   * Edges the API stores as the backward condition of another edge: index of the later edge →
   * index of the earlier one.
   *
   * @return array<int, int>
   */
  public static function reverseEdgeMerges(WorkflowGraph $graph): array
  {
    $merges = [];
    $taken = [];
    foreach ($graph->edges as $j => $later) {
      if ($later->source === $later->target || $later->backwardCondition !== null || $later->forwardCondition === null) {
        continue;
      }
      $found = null;
      foreach ($graph->edges as $k => $earlier) {
        if ($k >= $j) {
          break;
        }
        if (isset($taken[$k]) || isset($merges[$k])) {
          continue;
        }
        if (
          $earlier->source === $later->target
          && $earlier->target === $later->source
          && $earlier->backwardCondition === null
        ) {
          $found = $k;
          break;
        }
      }
      if ($found !== null) {
        $merges[$j] = $found;
        $taken[$found] = true;
      }
    }
    return $merges;
  }

  /**
   * Breadth-first depth of every node reachable from the start node, in visiting order.
   *
   * @return array<string, int>
   */
  public static function depthsFrom(WorkflowGraph $graph): array
  {
    $depths = [];
    $visit = function (string $id, int $depth) use (&$depths, $graph): void {
      $depths[$id] = $depth;
      $queue = [$id];
      while ($queue !== []) {
        $current = array_shift($queue);
        foreach ($graph->edges as $edge) {
          if ($edge->source === $current && !isset($depths[$edge->target]) && isset($graph->nodes[$edge->target])) {
            $depths[$edge->target] = $depths[$current] + 1;
            $queue[] = $edge->target;
          }
        }
      }
    };

    $visit($graph->startId, 0);
    while (true) {
      $back = null;
      foreach ($graph->edges as $edge) {
        if (
          $edge->backwardCondition !== null
          && isset($depths[$edge->target])
          && !isset($depths[$edge->source])
          && isset($graph->nodes[$edge->source])
        ) {
          $back = $edge;
          break;
        }
      }
      if ($back === null) {
        return $depths;
      }
      $visit($back->source, $depths[$back->target] + 1);
    }
  }

  private static function pairKey(string $a, string $b): string
  {
    return $a < $b ? "{$a}\0{$b}" : "{$b}\0{$a}";
  }
}
