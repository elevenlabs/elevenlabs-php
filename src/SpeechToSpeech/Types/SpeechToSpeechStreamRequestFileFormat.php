<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToSpeech\Types;

enum SpeechToSpeechStreamRequestFileFormat: string
{
  case PcmS16Le16 = 'pcm_s16le_16';
  case Other = 'other';
}
