<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum McpConnectionStatusMcpConnectionStatusIntegrationsItemIntegrationType: string
{
  case McpServer = 'mcp_server';
  case McpIntegration = 'mcp_integration';
}
