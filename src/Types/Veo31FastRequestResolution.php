<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output video.
 */
enum Veo31FastRequestResolution: string
{
  case SevenHundredTwentyP = '720p';
  case OneThousandEightyP = '1080p';
  case FourK = '4K';
}
