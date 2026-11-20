<?php

declare(strict_types=1);

namespace ElevenLabs\AgentsAsCode;

/**
 * Thrown by {@see Agent::validate()}, {@see Agent::toJson()} and {@see Agent::build()} when the
 * agent is invalid. Lists every problem found, not just the first.
 *
 * Hand-written (see `.fernignore`).
 */
final class AgentValidationError extends \RuntimeException
{
  /** @var list<AgentIssue> */
  public readonly array $issues;

  /**
   * @param list<AgentIssue> $issues
   */
  public function __construct(string $name, array $issues)
  {
    $this->issues = $issues;
    $lines = array_map(static fn(AgentIssue $i): string => "  - {$i->message}", $issues);
    parent::__construct("Invalid agent \"{$name}\":\n" . implode("\n", $lines));
  }
}
