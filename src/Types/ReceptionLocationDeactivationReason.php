<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Why a location is currently inactive.
 */
enum ReceptionLocationDeactivationReason: string
{
  case TierDowngrade = 'tier_downgrade';
  case User = 'user';
}
