<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Send the result to all of the workspace's configured flows webhooks.
 */
enum WebhookTargetAllType: string
{
  case All = 'all';
}
