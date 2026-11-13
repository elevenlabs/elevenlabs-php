<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum Verbosity: string
{
  case Auto = 'auto';
  case Concise = 'concise';
  case Thorough = 'thorough';
}
