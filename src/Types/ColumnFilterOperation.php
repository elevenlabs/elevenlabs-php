<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ColumnFilterOperation: string
{
  case In = 'in';
  case NotIn = 'not_in';
  case Le = 'le';
  case Ge = 'ge';
  case Lt = 'lt';
  case Gt = 'gt';
  case Eq = 'eq';
  case Neq = 'neq';
}
