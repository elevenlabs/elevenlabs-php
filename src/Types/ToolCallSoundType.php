<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Predefined tool call sounds; ``None`` means no sound.
 */
enum ToolCallSoundType: string
{
  case Typing = 'typing';
  case Elevator1 = 'elevator1';
  case Elevator2 = 'elevator2';
  case Elevator3 = 'elevator3';
  case Elevator4 = 'elevator4';
}
