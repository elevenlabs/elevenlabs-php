<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Content type for response filtering. Only 'application/json' responses are filtered.
 */
enum ResponseFilterContentType: string
{
  case ApplicationJson = 'application/json';
}
