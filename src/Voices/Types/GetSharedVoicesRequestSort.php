<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Types;

/**
 * Sort criteria. Must be one of: created_date, usage_character_count_1y, trending, cloned_by_count.
 */
enum GetSharedVoicesRequestSort: string
{
  case CreatedDate = 'created_date';
  case UsageCharacterCount1Y = 'usage_character_count_1y';
  case Trending = 'trending';
  case ClonedByCount = 'cloned_by_count';
}
