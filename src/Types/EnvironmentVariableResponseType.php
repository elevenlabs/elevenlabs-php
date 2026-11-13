<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EnvironmentVariableResponseType: string
{
  case String = 'string';
  case Secret = 'secret';
  case AuthConnection = 'auth_connection';
}
