<?php

declare(strict_types=1);

namespace ElevenLabs\History\Types;

enum ListHistoryRequestSource: string
{
  case Tts = 'TTS';
  case Sts = 'STS';
  case Flows = 'Flows';
}
