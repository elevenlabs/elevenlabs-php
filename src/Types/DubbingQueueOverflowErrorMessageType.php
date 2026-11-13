<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingQueueOverflowErrorMessageType: string
{
  case QueueOverflow = 'queue_overflow';
}
