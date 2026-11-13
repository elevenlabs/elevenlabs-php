<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SessionStartedConfigModelId: string
{
  case ScribeV2Realtime = 'scribe_v2_realtime';
  case ScribeV3Live = 'scribe_v3_live';
}
