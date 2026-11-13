<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingReleaseChannel: string
{
  case Stable = 'stable';
  case Release = 'release';
  case Experimental = 'experimental';
}
