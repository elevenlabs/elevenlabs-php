<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CalComConnectionHealthStatus: string
{
  case Healthy = 'healthy';
  case NeedsReauth = 'needs_reauth';
}
