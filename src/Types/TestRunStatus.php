<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TestRunStatus: string
{
  case Pending = 'pending';
  case Passed = 'passed';
  case Failed = 'failed';
  case Cancelled = 'cancelled';
}
