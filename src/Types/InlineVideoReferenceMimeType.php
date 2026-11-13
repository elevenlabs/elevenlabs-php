<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The MIME type of the encoded video.
 */
enum InlineVideoReferenceMimeType: string
{
  case VideoMp4 = 'video/mp4';
  case VideoQuicktime = 'video/quicktime';
  case VideoWebm = 'video/webm';
}
