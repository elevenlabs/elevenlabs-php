<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The time interval over which to aggregate the usage data.
 */
enum UsageAggregationInterval: string
{
  case Hour = 'hour';
  case Day = 'day';
  case Week = 'week';
  case Month = 'month';
  case Cumulative = 'cumulative';
}
