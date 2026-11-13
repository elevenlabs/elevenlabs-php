<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The aspect ratio of the output image.
 */
enum GptImage15RequestAspectRatio: string
{
  case One1 = '1:1';
  case Three2 = '3:2';
  case Two3 = '2:3';
}
