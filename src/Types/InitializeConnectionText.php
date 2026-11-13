<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The initial text that must be sent is a blank space.
 */
enum InitializeConnectionText: string
{
  case Empty = ' ';
}
