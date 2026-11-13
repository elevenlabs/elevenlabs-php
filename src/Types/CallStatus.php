<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CallStatus: string
{
  case Queued = 'queued';
  case Submitted = 'submitted';
  case Completed = 'completed';
  case Cancelled = 'cancelled';
  case Attention = 'attention';
}
