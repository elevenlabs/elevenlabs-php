<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * What a time-off entry blocks: a staff member, an asset, or a location.
 */
enum TimeOffType: string
{
  case Staff = 'staff';
  case Asset = 'asset';
  case Location = 'location';
}
