<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolExecutionMode: string
{
  case Immediate = 'immediate';
  case PostToolSpeech = 'post_tool_speech';
  case Async = 'async';
}
