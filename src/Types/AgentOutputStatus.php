<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentOutputStatus: string
{
  case InProgress = 'in_progress';
  case Completed = 'completed';
  case RequiresAction = 'requires_action';
  case Failed = 'failed';
  case TimedOut = 'timed_out';
}
