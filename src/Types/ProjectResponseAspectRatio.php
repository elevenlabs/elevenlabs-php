<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProjectResponseAspectRatio: string
{
  case Sixteen9 = '16:9';
  case Nine16 = '9:16';
  case Four5 = '4:5';
  case One1 = '1:1';
}
