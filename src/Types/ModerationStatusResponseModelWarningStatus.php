<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ModerationStatusResponseModelWarningStatus: string
{
  case Warning = 'warning';
  case WarningCleared = 'warning_cleared';
}
