<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolType: string
{
  case System = 'system';
  case Webhook = 'webhook';
  case Client = 'client';
  case Mcp = 'mcp';
  case Workflow = 'workflow';
  case ApiIntegrationWebhook = 'api_integration_webhook';
  case Smb = 'smb';
}
