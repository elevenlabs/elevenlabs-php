<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TtsOutputFormat: string
{
  case Pcm8000 = 'pcm_8000';
  case Pcm16000 = 'pcm_16000';
  case Pcm22050 = 'pcm_22050';
  case Pcm24000 = 'pcm_24000';
  case Pcm44100 = 'pcm_44100';
  case Pcm48000 = 'pcm_48000';
  case Ulaw8000 = 'ulaw_8000';
}
