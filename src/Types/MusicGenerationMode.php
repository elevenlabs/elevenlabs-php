<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MusicGenerationMode: string
{
  case Track = 'track';
  case Loop = 'loop';
  case Ambience = 'ambience';
  case VideoToMusic = 'video_to_music';
}
