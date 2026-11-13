<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OAuth2ClientCredsResponseAuthType: string
{
  case Oauth2ClientCredentials = 'oauth2_client_credentials';
}
