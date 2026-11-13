<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolInterruptionMode: string
{
  case Allow = 'allow';
  case DisableDuringTool = 'disable_during_tool';
  case DisableDuringToolAndTurn = 'disable_during_tool_and_turn';
}
