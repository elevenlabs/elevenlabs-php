<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The resolution of the output image.
 */
enum Gemini3ProImageRequestResolution: string
{
  case OneK = '1K';
  case TwoK = '2K';
  case FourK = '4K';
}
