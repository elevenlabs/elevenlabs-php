<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentChatResponsePartTextResponsePartType: string
{
  case Start = 'start';
  case Delta = 'delta';
  case Stop = 'stop';
}
