<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output video.
 */
enum CreatifyAuroraRequestResolution: string
{
  case FourHundredEightyP = '480p';
  case SevenHundredTwentyP = '720p';
}
