<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The status of the speaker separation.
 */
enum SpeakerSeparationResponseModelStatus: string
{
  case NotStarted = 'not_started';
  case Pending = 'pending';
  case Completed = 'completed';
  case Failed = 'failed';
}
