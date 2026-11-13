<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum RealtimeModel: string
{
  case ElevenRealtimeV1Mini = 'eleven_realtime_v1_mini';
  case ElevenRealtimeV1Max = 'eleven_realtime_v1_max';
}
