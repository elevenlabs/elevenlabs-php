<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Subscriptions\Types;

enum ChangeResellerTierRequestBillingPeriod: string
{
  case MonthlyPeriod = 'monthly_period';
  case AnnualPeriod = 'annual_period';
}
