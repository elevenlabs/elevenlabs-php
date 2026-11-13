<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The tier to change to.
 */
enum PendingSubscriptionSwitchResponseModelNextTier: string
{
  case Free = 'free';
  case Starter = 'starter';
  case Go = 'go';
  case Creator = 'creator';
  case Pro = 'pro';
  case GrowingBusiness = 'growing_business';
  case Scale20240810 = 'scale_2024_08_10';
  case GrantTier120250723 = 'grant_tier_1_2025_07_23';
  case GrantTier220250723 = 'grant_tier_2_2025_07_23';
  case Grant = 'grant';
  case Trial = 'trial';
  case Enterprise = 'enterprise';
}
