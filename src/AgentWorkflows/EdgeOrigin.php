<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * Where the next edge starts and which conditions it carries.
 *
 * Hand-written (see `.fernignore`).
 */
final class EdgeOrigin
{
  /**
   * @param array<string, mixed> $forwardCondition
   * @param array<string, mixed>|null $backwardCondition
   */
  public function __construct(
    public readonly string $source,
    public readonly array $forwardCondition,
    public readonly ?array $backwardCondition = null,
  ) {
  }
}
