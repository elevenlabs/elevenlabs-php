<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MediaCodec: string
{
  case G7228000 = 'G722/8000';
  case Pcmu8000 = 'PCMU/8000';
  case Pcma8000 = 'PCMA/8000';
}
