<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Types;

enum AllowedIps2: string
{
  case Clear = 'clear';
  case NoUpdate = 'no_update';
}
