<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools\Models;

use ElevenLabs\Types\WebhookToolApiSchemaConfigInput;

/**
 * @internal A webhook's api_schema as `build()` sends it. See {@see KeepsWireShape}.
 *
 * Hand-written (see `.fernignore`).
 */
final class WebhookApiSchemaModel extends WebhookToolApiSchemaConfigInput
{
  use KeepsWireShape;

  /**
   * Map fields written as JSON objects.
   *
   * @return list<string>
   */
  private function mapKeys(): array
  {
    return ['path_params_schema', 'request_headers'];
  }
}
