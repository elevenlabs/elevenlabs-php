<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OrderItemKind: string
{
  case Dub = 'dub';
  case Subtitles = 'subtitles';
  case Transcription = 'transcription';
}
