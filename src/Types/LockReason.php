<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum LockReason: string
{
  case TrialEnded = 'trial_ended';
  case SubscriptionDowngrade = 'subscription_downgrade';
  case ExposedPublicly = 'exposed_publicly';
  case SelfDisabled = 'self_disabled';
}
