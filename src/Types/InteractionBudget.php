<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum InteractionBudget: string
{
  case Realtime = 'realtime';
  case FiveMinutes = '5_minutes';
  case TenMinutes = '10_minutes';
  case OneHour = '1_hour';
}
