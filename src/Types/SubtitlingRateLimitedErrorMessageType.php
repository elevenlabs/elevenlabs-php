<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SubtitlingRateLimitedErrorMessageType: string
{
  case RateLimited = 'rate_limited';
}
