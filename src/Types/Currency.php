<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum Currency: string
{
  case Usd = 'usd';
  case Eur = 'eur';
  case Inr = 'inr';
  case Pln = 'pln';
  case Gbp = 'gbp';
}
