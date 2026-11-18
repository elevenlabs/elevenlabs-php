<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * A problem found in a workflow. Errors stop {@see Workflow::build()}; warnings are
 * passed to its `onWarning` callback.
 *
 * Hand-written (see `.fernignore`), mirroring the workflow builder in the Python/TS SDKs.
 */
final class WorkflowIssue
{
  /**
   * @param string $code One of the codes in the spec (duplicate_node_id, unknown_node, …).
   * @param "error"|"warning" $severity
   */
  public function __construct(
    public readonly string $code,
    public readonly string $severity,
    public readonly string $message,
    public readonly ?string $nodeId = null,
  ) {
  }
}
