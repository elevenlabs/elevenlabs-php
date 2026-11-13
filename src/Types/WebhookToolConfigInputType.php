<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of tool
 */
enum WebhookToolConfigInputType: string
{
  case Webhook = 'webhook';
}
