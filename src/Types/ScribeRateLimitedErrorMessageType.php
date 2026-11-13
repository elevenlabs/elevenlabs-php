<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeRateLimitedErrorMessageType: string
{
  case RateLimited = 'rate_limited';
}
