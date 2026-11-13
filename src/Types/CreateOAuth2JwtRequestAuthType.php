<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreateOAuth2JwtRequestAuthType: string
{
  case Oauth2Jwt = 'oauth2_jwt';
}
