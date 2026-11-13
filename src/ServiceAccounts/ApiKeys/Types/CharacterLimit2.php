<?php

declare(strict_types=1);

namespace ElevenLabs\ServiceAccounts\ApiKeys\Types;

enum CharacterLimit2: string
{
  case Clear = 'clear';
  case NoUpdate = 'no_update';
}
