<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum FineTuningResponseStateValue: string
{
  case NotStarted = 'not_started';
  case Queued = 'queued';
  case FineTuning = 'fine_tuning';
  case FineTuned = 'fine_tuned';
  case Failed = 'failed';
  case Delayed = 'delayed';
}
