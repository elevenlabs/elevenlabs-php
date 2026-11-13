<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeQueueOverflowErrorMessageType: string
{
  case QueueOverflow = 'queue_overflow';
}
