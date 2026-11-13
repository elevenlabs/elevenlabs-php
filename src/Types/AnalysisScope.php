<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisScope: string
{
  case Conversation = 'conversation';
  case Agent = 'agent';
}
