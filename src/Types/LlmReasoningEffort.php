<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum LlmReasoningEffort: string
{
  case None = 'none';
  case Minimal = 'minimal';
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
  case Xhigh = 'xhigh';
  case Max = 'max';
}
