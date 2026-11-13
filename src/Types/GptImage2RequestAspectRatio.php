<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The aspect ratio of the output image. With `auto`, the model picks an aspect ratio based on the inputs.
 */
enum GptImage2RequestAspectRatio: string
{
  case Auto = 'auto';
  case One1 = '1:1';
  case Four5 = '4:5';
  case Five4 = '5:4';
  case Three4 = '3:4';
  case Four3 = '4:3';
  case Two3 = '2:3';
  case Three2 = '3:2';
  case One2 = '1:2';
  case Two1 = '2:1';
  case Nine16 = '9:16';
  case Sixteen9 = '16:9';
  case TwentyOne9 = '21:9';
  case One3 = '1:3';
  case Three1 = '3:1';
}
