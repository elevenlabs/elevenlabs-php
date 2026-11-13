<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TelephonyDirection: string
{
  case Inbound = 'inbound';
  case Outbound = 'outbound';
}
