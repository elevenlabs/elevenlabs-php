<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

/**
 * A list whose elements match one schema. Create one with {@see Schema::array()}.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class ArraySchema extends Schema
{
  /** The element schema. Null only for a loaded array with no `items`, which `build()` reports. */
  public function items(): ?Schema
  {
    return $this->items;
  }
}
