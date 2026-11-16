<?php

declare(strict_types=1);

namespace ElevenLabs\AgentWorkflows;

/**
 * An edge in the workflow graph. Compared by identity (two edges with the same fields are
 * still two edges), matching the Python/TS references. Mutable: `build()` reads these fields
 * and the backward-condition merge references edges by identity.
 *
 * Hand-written (see `.fernignore`).
 */
final class GraphEdge
{
  /**
   * @param array<string, mixed>|null $forwardCondition
   * @param array<string, mixed>|null $backwardCondition
   * @param array<string, mixed> $extra Other fields of a loaded edge (e.g. `reroutes`), written back as-is.
   */
  public function __construct(
    public string $source,
    public string $target,
    public ?array $forwardCondition = null,
    public ?array $backwardCondition = null,
    public ?string $id = null,
    public array $extra = [],
  ) {
  }
}
