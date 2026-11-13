<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentConversationTicketSource: string
{
  case Qa = 'qa';
  case Agent = 'agent';
  case Manual = 'manual';
}
