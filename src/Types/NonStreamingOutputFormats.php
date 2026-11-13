<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum NonStreamingOutputFormats: string
{
  case Wav8000 = 'wav_8000';
  case Wav16000 = 'wav_16000';
  case Wav22050 = 'wav_22050';
  case Wav24000 = 'wav_24000';
  case Wav32000 = 'wav_32000';
  case Wav44100 = 'wav_44100';
  case Wav48000 = 'wav_48000';
}
