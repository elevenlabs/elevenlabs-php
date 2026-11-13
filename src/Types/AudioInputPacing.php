<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * ``BURSTY`` clients stream ahead of wall time, so decisions use the audio clock.
 */
enum AudioInputPacing: string
{
  case Realtime = 'realtime';
  case Bursty = 'bursty';
}
