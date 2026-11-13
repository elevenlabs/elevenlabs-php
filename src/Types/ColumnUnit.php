<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ColumnUnit: string
{
  case Ms = 'ms';
  case S = 's';
  case Min = 'min';
  case Duration = 'duration';
  case Credits = 'credits';
  case Usd = 'usd';
  case Eur = 'eur';
  case Inr = 'inr';
  case Pln = 'pln';
  case Gbp = 'gbp';
  case Ratio = 'ratio';
  case Rating = 'rating';
}
