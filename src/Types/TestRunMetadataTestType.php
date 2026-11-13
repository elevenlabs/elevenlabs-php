<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TestRunMetadataTestType: string
{
  case Llm = 'llm';
  case ToolCall = 'tool_call';
  case Simulation = 'simulation';
}
