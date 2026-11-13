<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SpeechHistoryItemResponseVoiceCategory: string
{
  case Premade = 'premade';
  case Cloned = 'cloned';
  case Generated = 'generated';
  case Professional = 'professional';
}
