<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CalendlyConnectionHealthStatus: string
{
  case Healthy = 'healthy';
  case NeedsReauth = 'needs_reauth';
}
