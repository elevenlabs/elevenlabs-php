<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum QualityPresetType: string
{
  case Standard = 'standard';
  case High = 'high';
  case Ultra = 'ultra';
  case UltraLossless = 'ultra_lossless';
}
