<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\TextToSpeech\Types;

enum ListTextToSpeechRequestStatus: string
{
  case Pending = 'pending';
  case Generating = 'generating';
  case Completed = 'completed';
  case Failed = 'failed';
}
