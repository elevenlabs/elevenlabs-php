<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingStatusStatus: string
{
  case Started = 'started';
  case Stopped = 'stopped';
}
