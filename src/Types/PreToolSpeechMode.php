<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum PreToolSpeechMode: string
{
  case Auto = 'auto';
  case Force = 'force';
  case Off = 'off';
}
