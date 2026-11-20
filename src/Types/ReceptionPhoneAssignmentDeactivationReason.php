<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Why a phone assignment is currently inactive.
 */
enum ReceptionPhoneAssignmentDeactivationReason: string
{
  case TierDowngrade = 'tier_downgrade';
  case NoEntitlement = 'no_entitlement';
  case User = 'user';
}
