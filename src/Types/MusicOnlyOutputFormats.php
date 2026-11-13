<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MusicOnlyOutputFormats: string
{
  case Mp348000128 = 'mp3_48000_128';
  case Mp348000192 = 'mp3_48000_192';
  case Mp348000240 = 'mp3_48000_240';
  case Mp348000320 = 'mp3_48000_320';
}
