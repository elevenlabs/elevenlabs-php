<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookAuthMethodType: string
{
  case Hmac = 'hmac';
  case Oauth2 = 'oauth2';
  case Mtls = 'mtls';
}
