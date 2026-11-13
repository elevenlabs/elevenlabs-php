<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum InternalAlertingWebhookNotifierType: string
{
  case Webhook = 'webhook';
}
