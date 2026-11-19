<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * Thrown by {@see Tool::build()}, {@see Tool::buildConfig()} and {@see Tool::toJson()} when the
 * tool is invalid. Lists every problem found, not just the first.
 */
final class ToolValidationError extends \RuntimeException
{
  /** @var list<ToolIssue> */
  public readonly array $issues;

  /**
   * @param list<ToolIssue> $issues
   */
  public function __construct(string $name, array $issues)
  {
    $this->issues = $issues;
    $lines = array_map(static fn(ToolIssue $i): string => "  - {$i->message}", $issues);
    parent::__construct("Invalid tool \"{$name}\":\n" . implode("\n", $lines));
  }
}
