<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum BatchCallRecipientStatus: string
{
  case Pending = 'pending';
  case Dispatched = 'dispatched';
  case Initiated = 'initiated';
  case InProgress = 'in_progress';
  case Completed = 'completed';
  case Failed = 'failed';
  case Cancelled = 'cancelled';
  case Voicemail = 'voicemail';
}
