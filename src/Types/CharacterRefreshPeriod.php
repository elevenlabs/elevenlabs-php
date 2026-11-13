<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CharacterRefreshPeriod: string
{
  case MonthlyPeriod = 'monthly_period';
  case ThreeMonthPeriod = '3_month_period';
  case SixMonthPeriod = '6_month_period';
  case AnnualPeriod = 'annual_period';
}
