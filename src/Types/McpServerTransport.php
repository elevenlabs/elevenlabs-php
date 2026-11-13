<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Supported MCP server transport types.
 */
enum McpServerTransport: string
{
  case Sse = 'SSE';
  case StreamableHttp = 'STREAMABLE_HTTP';
}
