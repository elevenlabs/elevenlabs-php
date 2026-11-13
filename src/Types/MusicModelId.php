<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MusicModelId: string
{
  case MusicV1 = 'music_v1';
  case MusicV2 = 'music_v2';
  case MusicV25 = 'music_v2_5';
}
