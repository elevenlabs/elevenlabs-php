<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentConversationTicketPriority: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
  case Urgent = 'urgent';
}
