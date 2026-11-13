<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Project\Types;

/**
 * Sort by creation time; newest first by default.
 */
enum ListProjectRequestSortDirection: string
{
  case Ascending = 'ASCENDING';
  case Descending = 'DESCENDING';
}
