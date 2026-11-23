<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Tool call status derived from execution flags.
 */
enum AgentToolResponseAgentToolResponseStatus: string
{
  case Success = 'success';
  case Error = 'error';
  case Blocked = 'blocked';
  case Skipped = 'skipped';
}
