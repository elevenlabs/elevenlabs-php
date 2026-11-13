<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Send the result to the listed flows webhooks.
 */
enum WebhookTargetIdsType: string
{
  case Ids = 'ids';
}
