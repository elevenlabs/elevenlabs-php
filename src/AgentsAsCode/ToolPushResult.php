<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * What {@see AgentsAsCode::push()} did to one tool.
 *
 * Hand-written (see `.fernignore`).
 */
final class ToolPushResult
{
  /**
   * @param "created"|"updated"|"unchanged"|"detached" $action `"detached"`: the agent used the
   *   tool before and no longer does. It isn't deleted.
   */
  public function __construct(
    public readonly string $id,
    public readonly string $action,
  ) {
  }
}
