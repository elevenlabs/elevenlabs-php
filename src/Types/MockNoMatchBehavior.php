<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MockNoMatchBehavior: string
{
  case CallRealTool = 'call_real_tool';
  case RaiseError = 'raise_error';
}
