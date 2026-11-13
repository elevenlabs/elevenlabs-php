<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DirectPublishingReadResponseModelPayoutType: string
{
  case None = 'none';
  case EngagementBased = 'engagement_based';
  case FixedPayout = 'fixed_payout';
}
