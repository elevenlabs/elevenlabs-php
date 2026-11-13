<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

/**
 * The field to use for ordering results from this query.
 */
enum ListDubbingRequestOrderBy: string
{
  case CreatedAt = 'created_at';
  case Name = 'name';
}
