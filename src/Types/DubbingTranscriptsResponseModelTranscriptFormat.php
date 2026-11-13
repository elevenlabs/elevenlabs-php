<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingTranscriptsResponseModelTranscriptFormat: string
{
  case Srt = 'srt';
  case Webvtt = 'webvtt';
  case Json = 'json';
}
