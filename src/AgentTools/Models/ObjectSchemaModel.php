<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools\Models;

use ElevenLabs\Types\ObjectJsonSchemaPropertyInput;

/**
 * @internal An object schema as `build()` sends it. See {@see KeepsWireShape}.
 *
 * Hand-written (see `.fernignore`).
 */
final class ObjectSchemaModel extends ObjectJsonSchemaPropertyInput
{
  use KeepsWireShape;

  /**
   * Map fields written as JSON objects.
   *
   * @return list<string>
   */
  private function mapKeys(): array
  {
    return ['properties'];
  }

  /** The public constant, which `keepConstant()` gives way to once it changes. */
  private function publicConstant(): mixed
  {
    return $this->constantValue;
  }
}
