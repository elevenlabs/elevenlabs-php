<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SipLogMessageDirection: string
{
  case In = 'in';
  case Out = 'out';
}
