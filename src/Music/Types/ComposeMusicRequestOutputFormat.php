<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Types;

enum ComposeMusicRequestOutputFormat: string
{
  case Auto = 'auto';
  case Mp348000128 = 'mp3_48000_128';
  case Mp348000192 = 'mp3_48000_192';
  case Mp348000240 = 'mp3_48000_240';
  case Mp348000320 = 'mp3_48000_320';
  case Mp32205032 = 'mp3_22050_32';
  case Mp32400048 = 'mp3_24000_48';
  case Mp34410032 = 'mp3_44100_32';
  case Mp34410064 = 'mp3_44100_64';
  case Mp34410096 = 'mp3_44100_96';
  case Mp344100128 = 'mp3_44100_128';
  case Mp344100192 = 'mp3_44100_192';
  case Pcm8000 = 'pcm_8000';
  case Pcm16000 = 'pcm_16000';
  case Pcm22050 = 'pcm_22050';
  case Pcm24000 = 'pcm_24000';
  case Pcm32000 = 'pcm_32000';
  case Pcm44100 = 'pcm_44100';
  case Pcm48000 = 'pcm_48000';
  case Ulaw8000 = 'ulaw_8000';
  case Alaw8000 = 'alaw_8000';
  case Opus4800032 = 'opus_48000_32';
  case Opus4800064 = 'opus_48000_64';
  case Opus4800096 = 'opus_48000_96';
  case Opus48000128 = 'opus_48000_128';
  case Opus48000192 = 'opus_48000_192';
}
