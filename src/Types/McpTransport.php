<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum McpTransport: string
{
  case Sse = 'SSE';
  case StreamableHttp = 'STREAMABLE_HTTP';
}
