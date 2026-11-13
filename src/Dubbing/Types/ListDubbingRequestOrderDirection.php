<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

/**
 * The order direction to use for results from this query.
 */
enum ListDubbingRequestOrderDirection: string
{
  case Descending = 'DESCENDING';
  case Ascending = 'ASCENDING';
}
