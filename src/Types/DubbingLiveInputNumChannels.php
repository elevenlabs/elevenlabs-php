<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Number of interleaved channels in raw PCM input. Must be 1 for ulaw.
 */
enum DubbingLiveInputNumChannels: int
{
  case One = 1;
  case Two = 2;
}
