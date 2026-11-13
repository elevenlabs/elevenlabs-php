<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Integration to deliver to. The server treats an omitted value as ``pagerduty``.
 */
enum AlertingIntegrationNotifierIntegrationType: string
{
  case Pagerduty = 'pagerduty';
  case Slack = 'slack';
}
