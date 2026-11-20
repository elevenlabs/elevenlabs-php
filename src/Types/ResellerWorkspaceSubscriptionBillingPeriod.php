<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ResellerWorkspaceSubscriptionBillingPeriod: string
{
  case MonthlyPeriod = 'monthly_period';
  case AnnualPeriod = 'annual_period';
}
