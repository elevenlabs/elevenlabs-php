<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeQuotaExceededErrorMessageType: string
{
  case QuotaExceeded = 'quota_exceeded';
}
