<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum IntervalPlacement: string
{
  case Start = 'start';
  case Random = 'random';
  case Rotate = 'rotate';
}
