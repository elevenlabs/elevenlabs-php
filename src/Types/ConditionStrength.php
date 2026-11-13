<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConditionStrength: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
  case Xhigh = 'xhigh';
}
