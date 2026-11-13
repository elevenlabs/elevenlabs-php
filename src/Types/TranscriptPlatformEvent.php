<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TranscriptPlatformEvent: string
{
  case UserTurnTimeout = 'user_turn_timeout';
  case SkipTurnWaitElapsed = 'skip_turn_wait_elapsed';
}
