<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Token field to extract from the token endpoint response.
 */
enum OAuth2JwtResponseTokenResponseField: string
{
  case AccessToken = 'access_token';
  case IdToken = 'id_token';
}
