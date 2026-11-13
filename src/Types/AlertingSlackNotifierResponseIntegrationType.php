<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AlertingSlackNotifierResponseIntegrationType: string
{
  case Slack = 'slack';
}
