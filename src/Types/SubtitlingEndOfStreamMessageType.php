<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SubtitlingEndOfStreamMessageType: string
{
  case EndOfStream = 'end_of_stream';
}
