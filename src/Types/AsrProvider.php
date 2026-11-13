<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AsrProvider: string
{
  case Elevenlabs = 'elevenlabs';
  case ScribeRealtime = 'scribe_realtime';
  case ScribeV2Turbo = 'scribe_v2_turbo';
}
