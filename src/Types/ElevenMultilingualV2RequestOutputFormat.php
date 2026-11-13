<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The audio encoding of the output, as `codec_sampleRateHz_bitrateKbps`. `mp3_44100_192` requires the Creator tier or above.
 */
enum ElevenMultilingualV2RequestOutputFormat: string
{
  case Mp32205032 = 'mp3_22050_32';
  case Mp32400048 = 'mp3_24000_48';
  case Mp34410032 = 'mp3_44100_32';
  case Mp34410064 = 'mp3_44100_64';
  case Mp34410096 = 'mp3_44100_96';
  case Mp344100128 = 'mp3_44100_128';
  case Mp344100192 = 'mp3_44100_192';
}
