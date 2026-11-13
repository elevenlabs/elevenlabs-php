<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The aspect ratio of the output video. With `auto`, the model picks an aspect ratio based on the inputs.
 */
enum BytedanceSeedance2FastRequestAspectRatio: string
{
  case Auto = 'auto';
  case TwentyOne9 = '21:9';
  case Sixteen9 = '16:9';
  case Four3 = '4:3';
  case One1 = '1:1';
  case Three4 = '3:4';
  case Nine16 = '9:16';
}
