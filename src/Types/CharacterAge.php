<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CharacterAge: string
{
  case Young = 'young';
  case MiddleAged = 'middle_aged';
  case Old = 'old';
}
