<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools\Models;

use ElevenLabs\Types\ArrayJsonSchemaPropertyInput;

/**
 * @internal An array schema as `build()` sends it. See {@see KeepsWireShape}.
 *
 * Hand-written (see `.fernignore`).
 */
final class ArraySchemaModel extends ArrayJsonSchemaPropertyInput
{
  use KeepsWireShape;

  /**
   * Map fields written as JSON objects.
   *
   * @return list<string>
   */
  private function mapKeys(): array
  {
    return [];
  }
}
