<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CallResult: string
{
  case Answered = 'answered';
  case Voicemail = 'voicemail';
  case Busy = 'busy';
  case NoAnswer = 'no_answer';
  case Failed = 'failed';
}
