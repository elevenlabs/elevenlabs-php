<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AlertingPagerDutyNotifierResponseIntegrationType: string
{
  case Pagerduty = 'pagerduty';
}
