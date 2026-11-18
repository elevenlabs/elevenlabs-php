<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * A problem found in a tool. Errors stop {@see Tool::build()}; warnings are passed to its
 * `onWarning` callback.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class ToolIssue
{
  /**
   * @param string $code One of the codes in the spec (missing_url, missing_value_source, …).
   * @param "error"|"warning" $severity
   * @param string|null $path Where the problem is, e.g. `"body.reason"` or `"pathParams.order_id"`.
   */
  public function __construct(
    public readonly string $code,
    public readonly string $severity,
    public readonly string $message,
    public readonly ?string $path = null,
  ) {
  }

  /** @internal */
  public static function error(string $code, ?string $path, string $message): self
  {
    return new self($code, 'error', $message, $path);
  }
}
