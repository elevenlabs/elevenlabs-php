<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * Thrown by {@see AgentsAsCode::push()} when an API call fails after it started writing. `result`
 * lists what was written before the failure, so nothing created goes unreported; with a project,
 * those ids are saved to it too. The failed call's exception is `getPrevious()`.
 *
 * Hand-written (see `.fernignore`).
 */
final class AgentPushError extends \RuntimeException
{
  public function __construct(string $step, public readonly AgentPushResult $result, \Throwable $cause)
  {
    parent::__construct("{$step}: {$cause->getMessage()}", 0, $cause);
  }
}
