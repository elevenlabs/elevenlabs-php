<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The HTTP method to use for the webhook
 */
enum WebhookToolApiSchemaConfigOutputMethod: string
{
  case Get = 'GET';
  case Post = 'POST';
  case Put = 'PUT';
  case Patch = 'PATCH';
  case Delete = 'DELETE';
}
