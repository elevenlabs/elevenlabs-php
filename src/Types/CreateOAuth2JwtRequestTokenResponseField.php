<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Token field to extract from the token endpoint response.
 */
enum CreateOAuth2JwtRequestTokenResponseField: string
{
  case AccessToken = 'access_token';
  case IdToken = 'id_token';
}
