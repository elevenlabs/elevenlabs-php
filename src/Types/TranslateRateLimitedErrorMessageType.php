<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TranslateRateLimitedErrorMessageType: string
{
  case RateLimited = 'rate_limited';
}
