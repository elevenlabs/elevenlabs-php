<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * A pending edge out of a node, opened by `when()`, `onSuccess()` or `onFailure()`. Has only
 * the node verbs and `goTo`.
 *
 * Hand-written (see `.fernignore`).
 */
final class WorkflowBranch extends WorkflowChain
{
  public function __construct(WorkflowGraph $graph, private readonly EdgeOrigin $from)
  {
    parent::__construct($graph);
  }

  /**
   * Open a branch out of `$source` carrying `$condition` as its forward condition (and an
   * optional backward condition).
   */
  public static function open(
    WorkflowGraph $graph,
    string $source,
    Condition|Expr|string $condition,
    Condition|Expr|string|null $back = null,
  ): self {
    return new self(
      $graph,
      new EdgeOrigin(
        source: $source,
        forwardCondition: Condition::from($condition)->toWire(),
        backwardCondition: $back === null ? null : Condition::from($back)->toWire(),
      ),
    );
  }

  protected function origin(): EdgeOrigin
  {
    return $this->from;
  }
}
