<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreateSecretEnvironmentVariableRequestType: string
{
  case Secret = 'secret';
}
