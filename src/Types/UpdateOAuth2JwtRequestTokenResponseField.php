<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UpdateOAuth2JwtRequestTokenResponseField: string
{
  case AccessToken = 'access_token';
  case IdToken = 'id_token';
}
