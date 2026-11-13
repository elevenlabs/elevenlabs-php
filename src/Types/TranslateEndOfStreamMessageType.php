<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TranslateEndOfStreamMessageType: string
{
  case EndOfStream = 'end_of_stream';
}
