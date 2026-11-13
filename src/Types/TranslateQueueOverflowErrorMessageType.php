<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TranslateQueueOverflowErrorMessageType: string
{
  case QueueOverflow = 'queue_overflow';
}
