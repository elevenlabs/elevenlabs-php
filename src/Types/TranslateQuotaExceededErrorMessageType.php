<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TranslateQuotaExceededErrorMessageType: string
{
  case QuotaExceeded = 'quota_exceeded';
}
