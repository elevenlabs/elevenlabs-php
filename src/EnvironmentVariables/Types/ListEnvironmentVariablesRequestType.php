<?php

declare(strict_types=1);

namespace ElevenLabs\EnvironmentVariables\Types;

enum ListEnvironmentVariablesRequestType: string
{
  case String = 'string';
  case Secret = 'secret';
  case AuthConnection = 'auth_connection';
}
