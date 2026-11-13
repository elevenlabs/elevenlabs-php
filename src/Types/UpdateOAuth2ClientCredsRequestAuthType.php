<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UpdateOAuth2ClientCredsRequestAuthType: string
{
  case Oauth2ClientCredentials = 'oauth2_client_credentials';
}
