<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UpdateOAuth2JwtRequestJwtUsage: string
{
  case AuthorizationGrant = 'authorization_grant';
  case ClientAuthentication = 'client_authentication';
}
