<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MessageSearchSortBy: string
{
  case SearchScore = 'search_score';
  case CreatedAt = 'created_at';
}
