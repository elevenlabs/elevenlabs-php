<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

/**
 * The mode in which to run this Dubbing job. Defaults to automatic, use manual if specifically providing a CSV transcript to use. Note that manual mode is experimental and production use is strongly discouraged.
 */
enum DubRequestMode: string
{
  case Automatic = 'automatic';
  case Manual = 'manual';
}
