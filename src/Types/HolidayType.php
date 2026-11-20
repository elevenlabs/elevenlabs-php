<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether the entry closes the target for the whole range or replaces its working hours.
 */
enum HolidayType: string
{
  case Closed = 'closed';
  case Override = 'override';
}
