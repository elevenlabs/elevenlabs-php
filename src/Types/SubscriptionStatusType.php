<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SubscriptionStatusType: string
{
  case Trialing = 'trialing';
  case Active = 'active';
  case Incomplete = 'incomplete';
  case PastDue = 'past_due';
  case Free = 'free';
  case FreeDisabled = 'free_disabled';
}
