<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How the receptionist's greeting plays.
 */
enum FirstMessageMode: string
{
  case Interruptible = 'interruptible';
  case Uninterruptible = 'uninterruptible';
  case RecordingNotice = 'recording_notice';
}
