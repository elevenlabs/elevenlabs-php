<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Controls how tool errors are processed before being shared with the agent.
 */
enum ToolErrorHandlingMode: string
{
  case Auto = 'auto';
  case Summarized = 'summarized';
  case Passthrough = 'passthrough';
  case Hide = 'hide';
}
