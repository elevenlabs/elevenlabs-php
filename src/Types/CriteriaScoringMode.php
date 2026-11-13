<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CriteriaScoringMode: string
{
  case Binary = 'binary';
  case NumericUniform = 'numeric_uniform';
}
