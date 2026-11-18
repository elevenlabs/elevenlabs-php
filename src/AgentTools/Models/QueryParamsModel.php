<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools\Models;

use ElevenLabs\Types\QueryParamsJsonSchemaInput;

/**
 * @internal A query params schema as `build()` sends it. See {@see KeepsWireShape}.
 *
 * Hand-written (see `.fernignore`).
 */
final class QueryParamsModel extends QueryParamsJsonSchemaInput
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
}
