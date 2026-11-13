<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * An empty string. Ignored by the server but resets the inactivity timeout for the context.
 */
enum KeepContextAliveText: string
{
  case Empty = '';
}
