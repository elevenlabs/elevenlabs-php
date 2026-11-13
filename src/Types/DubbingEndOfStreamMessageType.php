<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DubbingEndOfStreamMessageType: string
{
  case EndOfStream = 'end_of_stream';
}
