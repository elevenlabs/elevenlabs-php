<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum PendingClipTaskType: string
{
  case Preprocessing = 'preprocessing';
  case SpeechImport = 'speech_import';
  case Dubbing = 'dubbing';
  case VideoToMusic = 'video_to_music';
  case MediaGeneration = 'media_generation';
}
