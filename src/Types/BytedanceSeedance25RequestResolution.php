<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output video.
 */
enum BytedanceSeedance25RequestResolution: string
{
  case FourHundredEightyP = '480p';
  case SevenHundredTwentyP = '720p';
  case OneThousandEightyP = '1080p';
}
