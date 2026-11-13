<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OpenAiAudioFormat: string
{
  case AudioPcm = 'audio/pcm';
  case AudioPcmu = 'audio/pcmu';
}
