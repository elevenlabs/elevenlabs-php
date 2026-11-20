<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Why a receptionist is currently inactive (live calls disabled).
 */
enum ReceptionCustomerFacingAgentDeactivationReason: string
{
  case TierDowngrade = 'tier_downgrade';
  case User = 'user';
}
