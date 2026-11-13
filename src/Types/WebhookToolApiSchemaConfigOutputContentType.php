<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Content type for the request body. Only applies to POST/PUT/PATCH requests.
 */
enum WebhookToolApiSchemaConfigOutputContentType: string
{
  case ApplicationJson = 'application/json';
  case ApplicationXWwwFormUrlencoded = 'application/x-www-form-urlencoded';
}
