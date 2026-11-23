<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum QueueStatusQueueStatusEventStatus: string
{
  case Waiting = 'waiting';
  case Admitted = 'admitted';
  case TimedOut = 'timed_out';
}
