<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ClientToolCallEventType: string
{
  case ClientToolCall = 'client_tool_call';
}
