<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentConversationTicketStatus: string
{
  case Open = 'open';
  case InProgress = 'in_progress';
  case Resolved = 'resolved';
  case Cancelled = 'cancelled';
  case Merged = 'merged';
}
