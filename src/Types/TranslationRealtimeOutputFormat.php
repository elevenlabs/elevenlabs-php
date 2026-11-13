<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Audio encoding format for realtime translation output.
 */
enum TranslationRealtimeOutputFormat: string
{
  case Mp32205032 = 'mp3_22050_32';
  case Mp34410032 = 'mp3_44100_32';
  case Mp34410064 = 'mp3_44100_64';
  case Mp34410096 = 'mp3_44100_96';
  case Mp344100128 = 'mp3_44100_128';
  case Mp344100192 = 'mp3_44100_192';
  case Pcm16000 = 'pcm_16000';
  case Pcm22050 = 'pcm_22050';
  case Pcm24000 = 'pcm_24000';
  case Pcm44100 = 'pcm_44100';
  case Ulaw8000 = 'ulaw_8000';
}
