<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum Eagerness: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
}
