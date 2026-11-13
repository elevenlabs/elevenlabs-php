<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output image.
 */
enum Gemini31FlashImageRequestResolution: string
{
  case FiveHundredTwelve = '512';
  case OneK = '1K';
  case TwoK = '2K';
  case FourK = '4K';
}
