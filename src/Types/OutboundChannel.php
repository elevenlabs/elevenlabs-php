<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OutboundChannel: string
{
  case Phone = 'phone';
  case Whatsapp = 'whatsapp';
}
