<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentToolResponseStatus: string
{
  case Success = 'success';
  case Error = 'error';
  case Blocked = 'blocked';
  case Skipped = 'skipped';
}
