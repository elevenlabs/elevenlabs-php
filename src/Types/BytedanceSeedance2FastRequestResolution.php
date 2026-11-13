<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output video.
 */
enum BytedanceSeedance2FastRequestResolution: string
{
  case FourHundredEightyP = '480p';
  case SevenHundredTwentyP = '720p';
}
