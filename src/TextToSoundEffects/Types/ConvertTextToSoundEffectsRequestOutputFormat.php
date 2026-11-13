<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSoundEffects\Types;

/**
 * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
 */
enum ConvertTextToSoundEffectsRequestOutputFormat: string
{
  case Alaw8000 = 'alaw_8000';
  case Mp32205032 = 'mp3_22050_32';
  case Mp32400048 = 'mp3_24000_48';
  case Mp344100128 = 'mp3_44100_128';
  case Mp344100192 = 'mp3_44100_192';
  case Mp34410032 = 'mp3_44100_32';
  case Mp34410064 = 'mp3_44100_64';
  case Mp34410096 = 'mp3_44100_96';
  case Opus48000128 = 'opus_48000_128';
  case Opus48000192 = 'opus_48000_192';
  case Opus4800032 = 'opus_48000_32';
  case Opus4800064 = 'opus_48000_64';
  case Opus4800096 = 'opus_48000_96';
  case Pcm16000 = 'pcm_16000';
  case Pcm22050 = 'pcm_22050';
  case Pcm24000 = 'pcm_24000';
  case Pcm32000 = 'pcm_32000';
  case Pcm44100 = 'pcm_44100';
  case Pcm48000 = 'pcm_48000';
  case Pcm8000 = 'pcm_8000';
  case Ulaw8000 = 'ulaw_8000';
  case Wav16000 = 'wav_16000';
  case Wav22050 = 'wav_22050';
  case Wav24000 = 'wav_24000';
  case Wav32000 = 'wav_32000';
  case Wav44100 = 'wav_44100';
  case Wav48000 = 'wav_48000';
  case Wav8000 = 'wav_8000';
}
