<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

/**
 * Filters who created the resources being listed, whether it was the user running the request or someone else that shared the resource with them.
 */
enum ListDubbingRequestFilterByCreator: string
{
  case Personal = 'personal';
  case Others = 'others';
  case All = 'all';
}
