<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The authentication type for this webhook
 */
enum WebhookHmacSettingsAuthType: string
{
  case Hmac = 'hmac';
}
