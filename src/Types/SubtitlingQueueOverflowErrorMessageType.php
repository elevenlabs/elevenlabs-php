<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SubtitlingQueueOverflowErrorMessageType: string
{
  case QueueOverflow = 'queue_overflow';
}
