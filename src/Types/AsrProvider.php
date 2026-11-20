<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AsrProvider: string
{
  case Elevenlabs = 'elevenlabs';
  case ScribeRealtime = 'scribe_realtime';
  case ScribeV2Turbo = 'scribe_v2_turbo';
  case ScribeV3Live = 'scribe_v3_live';
  case ScribeV3LiveMedical = 'scribe_v3_live_medical';
}
