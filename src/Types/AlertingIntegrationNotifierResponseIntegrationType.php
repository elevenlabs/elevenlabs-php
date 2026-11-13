<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AlertingIntegrationNotifierResponseIntegrationType: string
{
  case Pagerduty = 'pagerduty';
  case Slack = 'slack';
}
