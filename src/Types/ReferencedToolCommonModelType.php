<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of the tool
 */
enum ReferencedToolCommonModelType: string
{
  case System = 'system';
  case Webhook = 'webhook';
  case Client = 'client';
  case Workflow = 'workflow';
  case ApiIntegrationWebhook = 'api_integration_webhook';
  case Mcp = 'mcp';
  case Code = 'code';
}
