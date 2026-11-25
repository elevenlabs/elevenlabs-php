<?php

declare(strict_types=1);

namespace ElevenLabs\History\Types;

enum ListHistoryRequestSourcesItem: string
{
  case Tts = 'TTS';
  case Sts = 'STS';
  case Flows = 'Flows';
}
