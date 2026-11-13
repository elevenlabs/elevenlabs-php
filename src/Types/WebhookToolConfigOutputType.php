<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of tool
 */
enum WebhookToolConfigOutputType: string
{
  case Webhook = 'webhook';
}
