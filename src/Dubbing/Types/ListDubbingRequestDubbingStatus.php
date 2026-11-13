<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

/**
 * What state the dub is currently in.
 */
enum ListDubbingRequestDubbingStatus: string
{
  case Dubbing = 'dubbing';
  case Dubbed = 'dubbed';
  case Failed = 'failed';
}
