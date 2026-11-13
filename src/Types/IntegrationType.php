<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum IntegrationType: string
{
  case McpServer = 'mcp_server';
  case McpIntegration = 'mcp_integration';
}
