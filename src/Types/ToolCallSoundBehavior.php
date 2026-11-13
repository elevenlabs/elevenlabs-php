<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Determines how the tool call sound should be played.
 */
enum ToolCallSoundBehavior: string
{
  case Auto = 'auto';
  case Always = 'always';
}
