<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolTypeFilter: string
{
  case Webhook = 'webhook';
  case Client = 'client';
  case ApiIntegrationWebhook = 'api_integration_webhook';
}
