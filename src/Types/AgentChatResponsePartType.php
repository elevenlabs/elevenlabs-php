<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentChatResponsePartType: string
{
  case Start = 'start';
  case Delta = 'delta';
  case Stop = 'stop';
}
