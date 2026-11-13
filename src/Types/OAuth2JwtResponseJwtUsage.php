<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How the JWT is used at the token endpoint. 'authorization_grant' sends it as a jwt-bearer grant. 'client_authentication' sends it as a client_assertion on a client_credentials request, with the subject as client_id and scopes in the request body.
 */
enum OAuth2JwtResponseJwtUsage: string
{
  case AuthorizationGrant = 'authorization_grant';
  case ClientAuthentication = 'client_authentication';
}
