<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * A problem found in an agent. Errors stop {@see Agent::validate()}, {@see Agent::toJson()} and
 * {@see Agent::build()}; warnings are passed to their `onWarning` callback.
 *
 * Hand-written (see `.fernignore`), mirroring the agent builder in the Python/TS SDKs.
 */
final class AgentIssue
{
  /**
   * @param string $code One of `missing_name`, `missing_prompt`, `duplicate_tool_name`,
   *   `invalid_tool`, `invalid_workflow`, `invalid_config`, `option_conflict`, `unresolved_tool`,
   *   `system_tool_in_workflow`.
   * @param "error"|"warning" $severity
   * @param ?string $path Where the problem is, e.g. `"tools.get_order"` or `"workflow"`.
   */
  public function __construct(
    public readonly string $code,
    public readonly string $severity,
    public readonly string $message,
    public readonly ?string $path = null,
  ) {
  }
}
