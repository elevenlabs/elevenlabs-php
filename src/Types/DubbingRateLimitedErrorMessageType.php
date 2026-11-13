<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingRateLimitedErrorMessageType: string
{
  case RateLimited = 'rate_limited';
}
