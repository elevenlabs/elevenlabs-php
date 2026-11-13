<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OutboundMode: string
{
  case Voice = 'voice';
  case Message = 'message';
}
