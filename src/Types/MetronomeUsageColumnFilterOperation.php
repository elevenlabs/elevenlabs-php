<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MetronomeUsageColumnFilterOperation: string
{
  case Eq = 'eq';
  case In = 'in';
  case Neq = 'neq';
  case NotIn = 'not_in';
}
