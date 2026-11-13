<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output image.
 */
enum GptImage2RequestResolution: string
{
  case OneK = '1K';
  case TwoK = '2K';
  case FourK = '4K';
}
