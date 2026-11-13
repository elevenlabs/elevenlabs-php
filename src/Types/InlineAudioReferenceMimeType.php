<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The MIME type of the encoded audio.
 */
enum InlineAudioReferenceMimeType: string
{
  case AudioMpeg = 'audio/mpeg';
  case AudioWav = 'audio/wav';
}
