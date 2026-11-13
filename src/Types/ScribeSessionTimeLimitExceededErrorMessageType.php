<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeSessionTimeLimitExceededErrorMessageType: string
{
  case SessionTimeLimitExceeded = 'session_time_limit_exceeded';
}
