<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum RenderType: string
{
  case Mp4 = 'mp4';
  case Aac = 'aac';
  case Mp3 = 'mp3';
  case Wav = 'wav';
  case Aaf = 'aaf';
  case TracksZip = 'tracks_zip';
  case ClipsZip = 'clips_zip';
  case Zip = 'zip';
}
