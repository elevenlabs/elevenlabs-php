<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AttentionStatus: string
{
  case Open = 'open';
  case Resolved = 'resolved';
  case Retrying = 'retrying';
}
