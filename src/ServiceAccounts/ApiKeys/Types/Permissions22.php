<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Types;

enum Permissions22: string
{
  case All = 'all';
  case NoUpdate = 'no_update';
}
