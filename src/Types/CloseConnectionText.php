<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * End the stream with an empty string.
 */
enum CloseConnectionText: string
{
  case Empty = '';
}
