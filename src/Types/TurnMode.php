<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TurnMode: string
{
  case Silence = 'silence';
  case Turn = 'turn';
}
