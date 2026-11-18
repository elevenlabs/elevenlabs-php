<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Thrown by {@see Workflow::build()} / {@see Workflow::toJson()} when the workflow is
 * invalid. Lists every problem found, not just the first.
 */
final class WorkflowValidationError extends \RuntimeException
{
  /** @var list<WorkflowIssue> */
  public readonly array $issues;

  /**
   * @param list<WorkflowIssue> $issues
   */
  public function __construct(array $issues)
  {
    $this->issues = $issues;
    $lines = array_map(static fn(WorkflowIssue $i): string => "  - {$i->message}", $issues);
    parent::__construct("Invalid workflow:\n" . implode("\n", $lines));
  }
}
