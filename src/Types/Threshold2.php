<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum Threshold2: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
}
