<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The aspect ratio of the output video.
 */
enum Veo31RequestAspectRatio: string
{
  case Sixteen9 = '16:9';
  case Nine16 = '9:16';
}
