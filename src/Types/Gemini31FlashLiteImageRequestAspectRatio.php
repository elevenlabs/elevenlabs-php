<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The aspect ratio of the output image. With `auto`, the model picks an aspect ratio based on the inputs.
 */
enum Gemini31FlashLiteImageRequestAspectRatio: string
{
  case Auto = 'auto';
  case One1 = '1:1';
  case Two3 = '2:3';
  case Three2 = '3:2';
  case Three4 = '3:4';
  case Four3 = '4:3';
  case Four5 = '4:5';
  case Five4 = '5:4';
  case Nine16 = '9:16';
  case Sixteen9 = '16:9';
  case TwentyOne9 = '21:9';
}
