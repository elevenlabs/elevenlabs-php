<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum BanReasonType: string
{
  case Safety = 'safety';
  case Manual = 'manual';
}
